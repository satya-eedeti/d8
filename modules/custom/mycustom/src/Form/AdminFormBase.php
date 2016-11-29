<?php

namespace Drupal\mycustom\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class AdminFormBase.
 *
 * @package Drupal\mycustom\Form
 */
class AdminFormBase extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'mycustom.adminformbase',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'admin_custom_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('mycustom.adminformbase');
    $form['app_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('App Id'),
      '#description' => $this->t('App Id for weather'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('app_id'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('mycustom.adminformbase')
      ->set('app_id', $form_state->getValue('app_id'))
      ->save();
  }

}
