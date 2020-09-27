<?php

/**
 * @file
 * Theme and preprocess functions for fields.
 */

/**
 * Implements hook_preprocess_field().
 */
function ucla_apigee_portal_preprocess_field(&$variables, $hook) {
  $element = $variables['element'];
  $vm = $element['#view_mode'];
  $field_name = $element['#field_name'];

  // Add a tags class for term reference label field on an entity full display.
  if (_ucla_apigee_portal_is_full_taxonomy_term_label($element)) {
    $variables['field_items_class'] = 'tags';
    $variables['is_heading'] = TRUE;
    $variables['margin_bottom'] = TRUE;

    // Loop through each item since these are multi-item fields.
    foreach ($variables['items'] as $key => $item) {
      // Add the tag classes to the link wrapper.
      $variables['items'][$key]['attributes']->setAttribute('class', 'tags__tag');
    }
  }

  // Make iframe videos and other embedded content responsive.
  if ($variables['element']['#formatter'] == 'oembed') {
    $ratio = ($variables['element'][0]['#attributes']['height'] / $variables['element'][0]['#attributes']['width']) * 100;
    $variables['attributes']['class'] = 'responsive-iframe';
    $variables['attributes']['style'] = 'padding-bottom: ' . round($ratio, 2) . '%';
  }

}

/**
 * Implements hook_theme_suggestions_field_alter().
 */
function ucla_apigee_portal_theme_suggestions_field_alter(array &$suggestions, array $variables) {
  $element = $variables['element'];

  // Add a theme suggestion for the view mode display of a specific node type
  // field--node--field-name--full.html.twig.
  $suggestions[] = 'field__' . $element['#entity_type'] . '__' . $element['#field_name'] . '__' . $element['#view_mode'];
  // field--node--field-name--bundle--full.html.twig.
  $suggestions[] = 'field__' . $element['#entity_type'] . '__' . $element['#field_name'] . '__' . $element['#bundle'] . '__' . $element['#view_mode'];

  // Add a theme suggestion for term reference label field on an entity full
  // display.
  if (_ucla_apigee_portal_is_full_taxonomy_term_label($element)) {
    // field--node--taxonomy-term-label--full.html.twig.
    $suggestions[] = 'field__' . $element['#entity_type'] . '__taxonomy_term_label__full';
  }
}

/**
 * Check if field is a term reference label on an full entity display.
 *
 * @param array $element
 *   The entity field to check for a term reference.
 *
 * @return bool
 *   Return TRUE if the field is on a full entity display with a term reference.
 */
function _ucla_apigee_portal_is_full_taxonomy_term_label(array $element) {

  if (_ucla_apigee_portal_is_full_vm($element['#view_mode'])
    && isset($element[0]['#options']['entity_type'])
    && $element[0]['#options']['entity_type'] == 'taxonomy_term'
    && $element['#formatter'] == 'entity_reference_label'
    && !in_array($element["#field_name"], $ignore_fields)
  ) {
    return TRUE;
  }

  return FALSE;
}

/**
 * Check if a View Mode is the Layout Builder or is the Full view mode.
 *
 * Currently Layout Builder will not return the View Mode that it is controlling
 * So we are assuming that if the layout builder is being used then it is the
 * same as the Full view mode.
 *
 * @param string $view_mode
 *   The current entity view mode.
 *
 * @return bool
 *   True if the Layout Builder is controlling the view mode or it is Full vm.
 */
function _ucla_apigee_portal_is_full_vm($view_mode) {
  return $view_mode == 'full' || $view_mode == '_custom' || substr($view_mode, 0, 14) === 'layout_builder';
}
