<?php
namespace Drupal\mycustom;

use \Drupal\node\Entity\NodeType;

class NodeListingPermissions {

  public function getNodeListingPermissions() {
    $types = NodeType::loadMultiple();
    $permissions = [];
    foreach ($types as $type) {
      $permissions[strtolower($type->get('name'))] = array('title' => $type->get('name'));
    }
    return $permissions;
  }
}