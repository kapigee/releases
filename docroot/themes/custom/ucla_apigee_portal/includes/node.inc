<?php

/**
 * @file
 * Theme and preprocess functions for node template.
 */

/**
 * Implements hook_preprocess_node().
 */
function ucla_apigee_portal_preprocess_node(&$variables) {
  $node = $variables['node'];
  $type = $node->getType();
  $vm = $variables['view_mode'];
}
