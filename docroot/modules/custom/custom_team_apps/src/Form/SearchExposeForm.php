<?php

namespace Drupal\custom_team_apps\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Url;

// Use Drupal\Component\Utility\String;.
/**
 * Class EnvSettingsForm.
 *
 * @package Drupal\xai\Form
 */
class SearchExposeForm extends FormBase {

  /**
   * {@inheritdoc}
   */

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ucla_exposed_home_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    //$config = \Drupal::service('config.factory')->getEditable('custom_team_apps.environment_settings_form');
    $form['search_ucla'] = [
      '#type' => 'textfield',
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

  /**
   * {@inheritdoc}
   */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $search_value = $form_state->getValue('search_ucla');
       $url = Url::fromRoute('view.api_catalog.page_1')->setRouteParameters(['name' => $search_value]);
       $form_state->setRedirectUrl($url);
    }

}
