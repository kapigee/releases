<?php

/**
 * @file
 * Theme and preprocess functions for page.
 */

/**
 * Implements hook_page_attachments_alter().
 */
function ucla_apigee_portal_page_attachments_alter(array &$page) {
  // Tell IE to use latest rendering engine (not to use compatibility mode).
  $ie_edge = [
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => [
      'http-equiv' => 'X-UA-Compatible',
      'content' => 'IE=edge,chrome=1',
    ],
  ];
  $page['#attached']['html_head'][] = [$ie_edge, 'ie_edge'];

  // iOS full screen enable.
  $meta_apple = [
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => [
      'http-equiv' => 'apple-mobile-web-app-capable',
      'content' => 'yes',
    ],
  ];
  $page['#attached']['html_head'][] = [$meta_apple, 'meta_apple'];
}

