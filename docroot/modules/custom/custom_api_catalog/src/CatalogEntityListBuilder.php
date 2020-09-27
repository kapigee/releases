<?php

namespace Drupal\custom_api_catalog;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Catalog entity entities.
 *
 * @ingroup custom_api_catalog
 */
class CatalogEntityListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Catalog entity ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $account = \Drupal::currentUser();
    $user_role = $account->getRoles();
    if(!in_array('administrator', $user_role)){
    $user_data  = \Drupal\user\Entity\User::load($account->id());
    if(!empty($entity->get('field_a')->getValue()) && !empty($user_data->get('field_product_category')->getValue()) && $user_data->get('field_product_category')->getValue() === $entity->get('field_a')->getValue()){

    /* @var \Drupal\custom_api_catalog\Entity\CatalogEntity $entity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.catalog_entity.edit_form',
      ['catalog_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
    }
    }
    else{
      $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.catalog_entity.edit_form',
      ['catalog_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
    }
  }

}
