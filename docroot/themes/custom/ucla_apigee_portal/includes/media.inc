<?php

/**
 * @file
 * Theme and preprocess functions for media.
 */

/**
 * Implements template_preprocess_media().
 */
function ucla_apigee_portal_preprocess_media(&$variables) {
  // Get the variables for the new, more specific render arrays passed through
  // to the template.
  if ($variables['elements']) {
    if (isset($variables['elements']['#linked_thumbnail'])) {
      $variables['content']['linked_thumbnail'] = $variables['elements']['#linked_thumbnail'];
    }
  }
}
