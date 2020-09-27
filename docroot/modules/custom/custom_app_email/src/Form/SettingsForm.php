<?php

namespace Drupal\custom_app_email\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\FormBase;

// Use Drupal\Component\Utility\String;.
/**
 * Class SettingsForm.
 *
 * @package Drupal\xai\Form
 */
class SettingsForm extends FormBase {

  /**
   * {@inheritdoc}
   */

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ucla_email_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = \Drupal::service('config.factory')->getEditable('custom_app_email.settings');

    $form['ucla_emails'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Please enter the Product Owner emails here:'),
      '#default_value' => $config->get('ucla_emails'),
      '#description' => t('Enter the emails separated by comma'),
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

    $config = \Drupal::service('config.factory')->getEditable('custom_app_email.settings');
    $config->set('ucla_emails', $form_state->getValue('ucla_emails'))->save();
    \Drupal::messenger()->addStatus(t('Product owner Emails are added successfully.!'));
  }

}
