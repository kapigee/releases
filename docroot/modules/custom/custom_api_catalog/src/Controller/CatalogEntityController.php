<?php

namespace Drupal\custom_api_catalog\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\custom_api_catalog\Entity\CatalogEntityInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class CatalogEntityController.
 *
 *  Returns responses for Catalog entity routes.
 */
class CatalogEntityController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * The date formatter.
   *
   * @var \Drupal\Core\Datetime\DateFormatter
   */
  protected $dateFormatter;

  /**
   * The renderer.
   *
   * @var \Drupal\Core\Render\Renderer
   */
  protected $renderer;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    $instance = parent::create($container);
    $instance->dateFormatter = $container->get('date.formatter');
    $instance->renderer = $container->get('renderer');
    return $instance;
  }

  /**
   * Displays a Catalog entity revision.
   *
   * @param int $catalog_entity_revision
   *   The Catalog entity revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($catalog_entity_revision) {
    $catalog_entity = $this->entityTypeManager()->getStorage('catalog_entity')
      ->loadRevision($catalog_entity_revision);
    $view_builder = $this->entityTypeManager()->getViewBuilder('catalog_entity');

    return $view_builder->view($catalog_entity);
  }

  /**
   * Page title callback for a Catalog entity revision.
   *
   * @param int $catalog_entity_revision
   *   The Catalog entity revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($catalog_entity_revision) {
    $catalog_entity = $this->entityTypeManager()->getStorage('catalog_entity')
      ->loadRevision($catalog_entity_revision);
    return $this->t('Revision of %title from %date', [
      '%title' => $catalog_entity->label(),
      '%date' => $this->dateFormatter->format($catalog_entity->getRevisionCreationTime()),
    ]);
  }

  /**
   * Generates an overview table of older revisions of a Catalog entity.
   *
   * @param \Drupal\custom_api_catalog\Entity\CatalogEntityInterface $catalog_entity
   *   A Catalog entity object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(CatalogEntityInterface $catalog_entity) {
    $account = $this->currentUser();
    $catalog_entity_storage = $this->entityTypeManager()->getStorage('catalog_entity');

    $langcode = $catalog_entity->language()->getId();
    $langname = $catalog_entity->language()->getName();
    $languages = $catalog_entity->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $catalog_entity->label()]) : $this->t('Revisions for %title', ['%title' => $catalog_entity->label()]);

    $header = [$this->t('Revision'), $this->t('Operations')];
    $revert_permission = (($account->hasPermission("revert all catalog entity revisions") || $account->hasPermission('administer catalog entity entities')));
    $delete_permission = (($account->hasPermission("delete all catalog entity revisions") || $account->hasPermission('administer catalog entity entities')));

    $rows = [];

    $vids = $catalog_entity_storage->revisionIds($catalog_entity);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\custom_api_catalog\CatalogEntityInterface $revision */
      $revision = $catalog_entity_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = $this->dateFormatter->format($revision->getRevisionCreationTime(), 'short');
        if ($vid != $catalog_entity->getRevisionId()) {
          $link = $this->l($date, new Url('entity.catalog_entity.revision', [
            'catalog_entity' => $catalog_entity->id(),
            'catalog_entity_revision' => $vid,
          ]));
        }
        else {
          $link = $catalog_entity->link($date);
        }

        $row = [];
        $column = [
          'data' => [
            '#type' => 'inline_template',
            '#template' => '{% trans %}{{ date }} by {{ username }}{% endtrans %}{% if message %}<p class="revision-log">{{ message }}</p>{% endif %}',
            '#context' => [
              'date' => $link,
              'username' => $this->renderer->renderPlain($username),
              'message' => [
                '#markup' => $revision->getRevisionLogMessage(),
                '#allowed_tags' => Xss::getHtmlTagList(),
              ],
            ],
          ],
        ];
        $row[] = $column;

        if ($latest_revision) {
          $row[] = [
            'data' => [
              '#prefix' => '<em>',
              '#markup' => $this->t('Current revision'),
              '#suffix' => '</em>',
            ],
          ];
          foreach ($row as &$current) {
            $current['class'] = ['revision-current'];
          }
          $latest_revision = FALSE;
        }
        else {
          $links = [];
          if ($revert_permission) {
            $links['revert'] = [
              'title' => $this->t('Revert'),
              'url' => $has_translations ?
              Url::fromRoute('entity.catalog_entity.translation_revert', [
                'catalog_entity' => $catalog_entity->id(),
                'catalog_entity_revision' => $vid,
                'langcode' => $langcode,
              ]) :
              Url::fromRoute('entity.catalog_entity.revision_revert', [
                'catalog_entity' => $catalog_entity->id(),
                'catalog_entity_revision' => $vid,
              ]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.catalog_entity.revision_delete', [
                'catalog_entity' => $catalog_entity->id(),
                'catalog_entity_revision' => $vid,
              ]),
            ];
          }

          $row[] = [
            'data' => [
              '#type' => 'operations',
              '#links' => $links,
            ],
          ];
        }

        $rows[] = $row;
      }
    }

    $build['catalog_entity_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

}
