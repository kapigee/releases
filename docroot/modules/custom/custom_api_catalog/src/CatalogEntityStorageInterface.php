<?php

namespace Drupal\custom_api_catalog;

use Drupal\Core\Entity\ContentEntityStorageInterface;
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
interface CatalogEntityStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Catalog entity revision IDs for a specific Catalog entity.
   *
   * @param \Drupal\custom_api_catalog\Entity\CatalogEntityInterface $entity
   *   The Catalog entity entity.
   *
   * @return int[]
   *   Catalog entity revision IDs (in ascending order).
   */
  public function revisionIds(CatalogEntityInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Catalog entity author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Catalog entity revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\custom_api_catalog\Entity\CatalogEntityInterface $entity
   *   The Catalog entity entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(CatalogEntityInterface $entity);

  /**
   * Unsets the language for all Catalog entity with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
