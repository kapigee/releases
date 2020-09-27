<?php

namespace Drupal\custom_team_apps\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\FormBase;

// Use Drupal\Component\Utility\String;.
/**
 * Class EnvSettingsForm.
 *
 * @package Drupal\xai\Form
 */
class EnvSettingsForm extends FormBase {

  /**
   * {@inheritdoc}
   */

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ucla_environment_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = \Drupal::service('config.factory')->getEditable('custom_team_apps.environment_settings_form');

    $form['ucla_env_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Environment Name'),
      '#default_value' => $config->get('ucla_env_name'),
      '#description' => t('Enter the Environment Name.'),
      '#maxlength' => 3,
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
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
    $config = \Drupal::service('config.factory')->getEditable('custom_team_apps.environment_settings_form');
    $config->set('ucla_env_name', $form_state->getValue('ucla_env_name'))->save();
    \Drupal::messenger()->addStatus(t('Environment name has been successfully updated!'));
  }

}
