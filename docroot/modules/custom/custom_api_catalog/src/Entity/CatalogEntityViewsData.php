<?php

namespace Drupal\custom_api_catalog\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Catalog entity entities.
 */
class CatalogEntityViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.
    return $data;
  }

}
