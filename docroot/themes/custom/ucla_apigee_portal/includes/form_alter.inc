<?php

/**
 * @file
 * Form alter functions.
 */

use Drupal\Core\Form\FormStateInterface;

/**
 * Implements hook_form_alter().
 */
function ucla_apigee_portal_form_alter(&$form, FormStateInterface $form_state, $form_id) {
  // Add appropriate classes to the Search Form page inputs.
  if ($form_id == 'search_form') {
    // Remove the .search-form class if present.
    if (!empty($form['#attributes']['class'])) {
      $search_class = array_search('search-form', $form['#attributes']['class']);
      if ($search_class !== FALSE) {
        unset($form['#attributes']['class'][$search_class]);
      }
    }

    // Remove the inline container class if present.
    if (!empty($form['basic']['#attributes']['class'])) {
      $container_class = array_search('container-inline', $form['basic']['#attributes']['class']);
      if ($container_class !== FALSE) {
        unset($form['basic']['#attributes']['class'][$container_class]);
      }
    }

    $form['basic']['#attributes']['class'][] = 'search-form';
    $form['basic']['keys']['#attributes']['class'][] = 'search-form__input';
    $form['basic']['keys']['#attributes']['placeholder'] = 'Search ...';
    $form['basic']['keys']['#attributes']['required'] = 'required';
    $form['basic']['submit']['#attributes']['class'][] = 'search-form__btn';
  }
}
