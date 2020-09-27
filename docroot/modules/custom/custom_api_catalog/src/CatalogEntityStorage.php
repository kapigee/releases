<?php

namespace Drupal\custom_api_catalog;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\custom_api_catalog\Entity\CatalogEntityInterface;

/**
 * Defines the storage handler class for Catalog entity entities.
 *
 * This extends the base storage class, adding required special handling for
 * Catalog entity entities.
 *
 * @ingroup custom_api_catalog
 */
class CatalogEntityStorage extends SqlContentEntityStorage implements CatalogEntityStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(CatalogEntityInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {catalog_entity_revision} WHERE id=:id ORDER BY vid',
      [':id' => $entity->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {catalog_entity_field_revision} WHERE uid = :uid ORDER BY vid',
      [':uid' => $account->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(CatalogEntityInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {catalog_entity_field_revision} WHERE id = :id AND default_langcode = 1', [':id' => $entity->id()])
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('catalog_entity_revision')
      ->fields(['langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED])
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
