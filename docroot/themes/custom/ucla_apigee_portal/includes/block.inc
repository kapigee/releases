<?php

/**
 * @file
 * Theme and preprocess functions for block.
 */

use Drupal\block\Entity\Block;
use Drupal\file\Entity\File;
use Drupal\media\Entity\Media;

/**
 * Implements hook_preprocess_block().
 */
function ucla_apigee_portal_preprocess_block(array &$variables) {
  $bundle = (isset($variables['content']['#block_content']) ? $variables['content']['#block_content']->bundle() : false);

  // Apply styles based on region.
  _ucla_apigee_portal_block_region_styles($variables);

  // Apply a full width style to blocks.
  if (isset($variables['configuration']['block_styles']['full_width']['full_width']) && $variables['configuration']['block_styles']['full_width']['full_width'] == 1) {
    $variables['attributes']['class'][] = 'l-full-width';
  }
 
}

/**
 * Implements hook_theme_suggestions_block_alter().
 */
function ucla_apigee_portal_theme_suggestions_block_alter(array &$suggestions, array $variables) {
  // Add theme suggestions for custom blocks.
  if (isset($variables['elements']['content']['#block_content'])) {
    $pattern = 'block__' . $variables['elements']['content']['#block_content']->bundle();

    // Add the suggestion after normal block suggestions but before single
    // specific id suggestions.
    array_splice($suggestions, 2, 0, $pattern);
  }

  $patterns = [];
  $plugin_id = $variables['elements']['#plugin_id'];
  $base_plugin_id = $variables['elements']['#base_plugin_id'];

  // Everything below requires access the the Block class.
  if (empty($variables['elements']['#id'])) {
    return;
  }
  $block = Block::load($variables['elements']['#id']);

  // Exit out if a block can not be found.
  if (!$block) {
    return;
  }

  $region = $block->getRegion();

  // Search Bar.
  if ($plugin_id == 'search_form_block' && $region == 'navigation') {
    $patterns[] = 'block__search_bar';
  }

  // Theme all menus by region.
  if ($base_plugin_id == 'system_menu_block' || $base_plugin_id == 'menu_block') {
    $patterns[] = 'block__menu__region_' . $region;
    $patterns[] = 'block__menu__' . $variables['elements']['#derivative_plugin_id'] . '__region_' . $region;
  }

  // Add the suggestion after normal block suggestions but before single
  // specific id suggestions.
  array_splice($suggestions, 2, 0, $patterns);
}

/**
 * Style blocks within a region.
 *
 * @param array $variables
 *   The variable sent to twig templates.
 */
function _ucla_apigee_portal_block_region_styles(array &$variables) {
  // Exit if there is no block ID (likely because it is a field block).
  if (empty($variables['elements']['#id'])) {
    return;
  }

  $block = Block::load($variables['elements']['#id']);

  // Exit out if a block can not be found.
  if (!$block) {
    return;
  }

  // Get the region.
  $region = $block->getRegion();

  // Get the plugin id.
  $plugin_id = $block->getPlugin()->getPluginId();

  // Primary Nav / Main Menu.
  if ($region == 'navigation'
    && ($plugin_id == 'system_menu_block:main' || $plugin_id == 'menu_block:main')) {
    $variables['attributes']['class'][] = 'nav-primary';
    // Add in the region so it can be used in suggestions_menu_alter hooks.
    $variables['content']['#attributes']['region'] = $region;
  }

  // Search Forms.
  if ($plugin_id == 'search_form_block') {
    // Search Bar.
    if ($region == 'navigation') {
      $theme_path = base_path() . drupal_get_path('theme', 'ucla_apigee_portal') . '/images/';

      $variables['content']['#attributes']['class'][] = 'search-bar__form';
      $variables['content']['keys']['#prefix'] = '<span class="search-bar__icon"><img src="' . $theme_path . 'icons/search.svg" alt="Search Icon"></span>';
      $variables['content']['keys']['#title'] = t('Search the site:');
      $variables['content']['keys']['#attributes']['placeholder'] = 'Search...';
      $variables['content']['keys']['#attributes']['required'] = 'required';
      $variables['content']['keys']['#attributes']['class'][] = 'search-bar__input';
      $variables['content']['actions']['submit']['#attributes']['class'][] = 'btn';
      $variables['content']['actions']['submit']['#attributes']['class'][] = 'search-bar__submit';
    }
    // Regular search form.
    else {
      $variables['content']['#attributes']['class'][] = 'search-form';
      $variables['content']['keys']['#attributes']['placeholder'] = 'Search  ...';
      $variables['content']['keys']['#attributes']['required'] = 'required';
      $variables['content']['keys']['#attributes']['class'][] = 'search-form__input';
      $variables['content']['actions']['submit']['#attributes']['class'][] = 'search-form__btn';
    }
  }

  // Add .panel if Content or Sidebar regions.
  $box_regions = [
    'sidebar_first',
    'sidebar_second',
    'content',
  ];
  if (in_array($region, $box_regions)) {
    $variables['class_panel'] = (isset($variables['class_panel'])) ? $variables['class_panel'] : TRUE;
  }

}
