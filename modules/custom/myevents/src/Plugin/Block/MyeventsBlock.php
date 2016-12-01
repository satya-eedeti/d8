<?php

namespace Drupal\myevents\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use AntoineAugusti\Books\Fetcher;
use GuzzleHttp\Client;

/**
 * Provides a 'MyeventsBlock' block.
 *
 * @Block(
 *  id = "myevents_block",
 *  admin_label = @Translation("Myevents ISBI"),
 * )
 */
class MyeventsBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['isbn'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('ISBN'),
      '#description' => $this->t(''),
      '#default_value' => isset($this->configuration['isbn']) ? $this->configuration['isbn'] : '',
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['isbn'] = $form_state->getValue('isbn');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $client = new Client(['base_uri' => 'https://www.googleapis.com/books/v1/']);
    $fetcher = new Fetcher($client);
    $book = $fetcher->forISBN('9780142181119');

    //echo $book->title;
    $build = [];
    $build['myevents_block_isbn']['#markup'] = '<p>Booke name is <strong>' . $book->title . '</strong></p>';

    return $build;
  }

}
