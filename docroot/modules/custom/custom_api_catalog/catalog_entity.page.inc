<?php

/**
 * @file
 * Contains catalog_entity.page.inc.
 *
 * Page callback for Catalog entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Catalog entity templates.
 *
 * Default template: catalog_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_catalog_entity(array &$variables) {
  // Fetch CatalogEntity Entity Object.
  $catalog_entity = $variables['elements']['#catalog_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
