<?php

namespace Drupal\custom_api_catalog;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Catalog entity entity.
 *
 * @see \Drupal\custom_api_catalog\Entity\CatalogEntity.
 */
class CatalogEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\custom_api_catalog\Entity\CatalogEntityInterface $entity */

    switch ($operation) {

      case 'view':

        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished catalog entity entities');
        }


        return AccessResult::allowedIfHasPermission($account, 'view published catalog entity entities');

      case 'update':

        return AccessResult::allowedIfHasPermission($account, 'edit catalog entity entities');

      case 'delete':

        return AccessResult::allowedIfHasPermission($account, 'delete catalog entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add catalog entity entities');
  }


}
