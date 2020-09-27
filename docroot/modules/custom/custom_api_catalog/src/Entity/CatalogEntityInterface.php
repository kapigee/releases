<?php

namespace Drupal\custom_api_catalog\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Catalog entity entities.
 *
 * @ingroup custom_api_catalog
 */
interface CatalogEntityInterface extends ContentEntityInterface, RevisionLogInterface, EntityChangedInterface, EntityPublishedInterface, EntityOwnerInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Catalog entity name.
   *
   * @return string
   *   Name of the Catalog entity.
   */
  public function getName();

  /**
   * Sets the Catalog entity name.
   *
   * @param string $name
   *   The Catalog entity name.
   *
   * @return \Drupal\custom_api_catalog\Entity\CatalogEntityInterface
   *   The called Catalog entity entity.
   */
  public function setName($name);

  /**
   * Gets the Catalog entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Catalog entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Catalog entity creation timestamp.
   *
   * @param int $timestamp
   *   The Catalog entity creation timestamp.
   *
   * @return \Drupal\custom_api_catalog\Entity\CatalogEntityInterface
   *   The called Catalog entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Gets the Catalog entity revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Catalog entity revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\custom_api_catalog\Entity\CatalogEntityInterface
   *   The called Catalog entity entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Catalog entity revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Catalog entity revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\custom_api_catalog\Entity\CatalogEntityInterface
   *   The called Catalog entity entity.
   */
  public function setRevisionUserId($uid);

}
