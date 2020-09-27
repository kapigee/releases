<?php

namespace Drupal\custom_api_catalog\Form;

use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a form for deleting a Catalog entity revision.
 *
 * @ingroup custom_api_catalog
 */
class CatalogEntityRevisionDeleteForm extends ConfirmFormBase {

  /**
   * The Catalog entity revision.
   *
   * @var \Drupal\custom_api_catalog\Entity\CatalogEntityInterface
   */
  protected $revision;

  /**
   * The Catalog entity storage.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected $catalogEntityStorage;

  /**
   * The database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $connection;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    $instance = parent::create($container);
    $instance->catalogEntityStorage = $container->get('entity_type.manager')->getStorage('catalog_entity');
    $instance->connection = $container->get('database');
    return $instance;
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'catalog_entity_revision_delete_confirm';
  }

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to delete the revision from %revision-date?', [
      '%revision-date' => format_date($this->revision->getRevisionCreationTime()),
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return new Url('entity.catalog_entity.version_history', ['catalog_entity' => $this->revision->id()]);
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return $this->t('Delete');
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $catalog_entity_revision = NULL) {
    $this->revision = $this->CatalogEntityStorage->loadRevision($catalog_entity_revision);
    $form = parent::buildForm($form, $form_state);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->CatalogEntityStorage->deleteRevision($this->revision->getRevisionId());

    $this->logger('content')->notice('Catalog entity: deleted %title revision %revision.', ['%title' => $this->revision->label(), '%revision' => $this->revision->getRevisionId()]);
    $this->messenger()->addMessage(t('Revision from %revision-date of Catalog entity %title has been deleted.', ['%revision-date' => format_date($this->revision->getRevisionCreationTime()), '%title' => $this->revision->label()]));
    $form_state->setRedirect(
      'entity.catalog_entity.canonical',
       ['catalog_entity' => $this->revision->id()]
    );
    if ($this->connection->query('SELECT COUNT(DISTINCT vid) FROM {catalog_entity_field_revision} WHERE id = :id', [':id' => $this->revision->id()])->fetchField() > 1) {
      $form_state->setRedirect(
        'entity.catalog_entity.version_history',
         ['catalog_entity' => $this->revision->id()]
      );
    }
  }

}
