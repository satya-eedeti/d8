<?php
namespace Drupal\training\Controller;

use \Drupal\Core\Controller\ControllerBase;
class NodeListingController extends ControllerBase {
  public function content() {
    return array(
      '#type' => 'markup',
      '#markup' => 'coming'
    );
  }
}
