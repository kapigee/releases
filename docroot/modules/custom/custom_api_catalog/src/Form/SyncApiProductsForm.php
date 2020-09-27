<?php

namespace Drupal\custom_api_catalog\Form;

use Apigee\Edge\Api\Management\Controller\ApiProductController;
use Drupal\custom_api_catalog\Entity\CatalogEntity;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\apigee_edge\SDKConnector;
use Drupal\taxonomy\Entity\Term;

/**
 * Class SyncApiProductsForm.
 */
class SyncApiProductsForm extends FormBase
{

  /**
   * Drupal\apigee_edge\SDKConnectorInterface definition.
   *
   * @var \Drupal\apigee_edge\SDKConnectorInterface
   */
  protected $apigeeEdgeSdkConnector;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container)
  {
    return new static(
      $container->get('apigee_edge.sdk_connector')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function __construct(SDKConnector $apigeeEdgeSdkConnector)
  {
    $this->apigeeEdgeSdkConnector = $apigeeEdgeSdkConnector;
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'sync_api_products_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    foreach ($form_state->getValues() as $key => $value) {
      // @TODO: Validate fields.
    }
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $products = \Drupal::entityTypeManager()
      ->getStorage('catalog_entity')
      ->loadMultiple();
    $existing_products = [];
    foreach ($products as $product) {
      $existing_products[] = $product->get('name')->getValue()[0]['value'];
    }
    $client = $this->apigeeEdgeSdkConnector->getClient();
    $product_controller = new ApiProductController($this->apigeeEdgeSdkConnector->getOrganization(), $client);
    $api_products = $product_controller->getEntities();
    $terms = \Drupal::entityTypeManager()
      ->getStorage('taxonomy_term')
      ->loadTree('app_domain_and_sub_domain');

    $existing_terms = [];
    foreach ($terms as $term) {
      $existing_terms[] = $term->name;
    }
   // kint($existing_terms);
    foreach ($api_products as $api_product) {
      $environment = '';
      if (in_array('qa', $api_product->getEnvironments()) && in_array('prod', $api_product->getEnvironments())) {
        $environment = '';
      }
      if (in_array('qa', $api_product->getEnvironments())) {
        $environment = 'qa';
      }
      if (in_array('prod', $api_product->getEnvironments())) {
        $environment = 'prod';
      }
      if (in_array('qa', $api_product->getEnvironments()) && in_array('prod', $api_product->getEnvironments())) {
        $environment = '';
      }
      if ((!in_array($api_product->getName(), $existing_products))) {
        if ($api_product->getAttributes()->getValue('DEV-PORTAL-APP-DOMAIN') != '') {
          $term = $api_product->getAttributes()->getValue('DEV-PORTAL-APP-DOMAIN');
          $term_exploded = explode("/", $term);
          if (!in_array($term_exploded[1], $existing_terms)) {
            $new_term = Term::create(
              [
                'vid' => 'app_domain_and_sub_domain',
                'name' => $term_exploded[1]
              ]
            );
            $new_term->enforceIsNew();
            $new_term->save();
            $term_ids_1 = $new_term->id();
            $existing_terms[] = $new_term->getName();
            if ($term_exploded[2]) {
              if (!in_array($term_exploded[2], $existing_terms)) {
                $new_term2 = Term::create(
                  [
                    'vid' => 'app_domain_and_sub_domain',
                    'name' => $term_exploded[2]
                  ]
                );
                $new_term2->enforceIsNew();
                $existing_terms[] = $new_term2->getName();
                $new_term2->parent = $new_term->id();
                $new_term2->save();
                $term_ids_2 = $new_term2->id();
              }
            }
          }
        }
        $product = CatalogEntity::create(
          [
            'name' => $api_product->getName(),
            'field_environment' => $environment,
            'field_product_type' => $api_product->getAttributes()->getValue('DEV-PORTAL-PRODUCT-TYPE'),
            'field_portal_visibility' => $api_product->getAttributes()->getValue('DEV-PORTAL-VISIBILITY'),
            'field_a' => [$term_ids_1,$term_ids_2],
          ]
        );
        $product->save();
      } else {
        $update_product = reset(\Drupal::entityTypeManager()->getStorage('catalog_entity')->loadByProperties(['name' => $api_product->getName()]));
        if ($api_product->getAttributes()->getValue('DEV-PORTAL-APP-DOMAIN') != '') {
          $term = $api_product->getAttributes()->getValue('DEV-PORTAL-APP-DOMAIN');
          $term_exploded = explode("/", $term);
          if (!in_array($term_exploded[1], $existing_terms)) {
            $new_term = Term::create(
              [
                'vid' => 'app_domain_and_sub_domain',
                'name' => $term_exploded[1]
              ]
            );
            $new_term->enforceIsNew();
            $new_term->save();
            $term_ids_1 = $new_term->id();
            $existing_terms[] = $new_term->getName();
            if ($term_exploded[2]) {
              if (!in_array($term_exploded[2], $existing_terms)) {
                $new_term2 = Term::create(
                  [
                    'vid' => 'app_domain_and_sub_domain',
                    'name' => $term_exploded[2]
                  ]
                );
                $new_term2->enforceIsNew();
                $existing_terms[] = $new_term2->getName();
                $new_term2->parent = $new_term->id();
                $new_term2->save();
                $term_ids_2 = $new_term2->id();
              }
            }
          }
          $update_product->set('field_a', [$term_ids_1,$term_ids_2]);
        }
        $update_product->set('field_environment', $environment);
        $update_product->set('field_product_type', $api_product->getAttributes()->getValue('DEV-PORTAL-PRODUCT-TYPE'));
        $update_product->set('field_portal_visibility', $api_product->getAttributes()->getValue('DEV-PORTAL-VISIBILITY'));
        $update_product->save();
      }
      $url = Url::fromUri("internal:/admin/structure/catalog_entity");
      $form_state->setRedirectUrl($url);
      \Drupal::messenger()->addMessage(t('Products are Synced with Apigee Edge.'));
    }
  }
}
