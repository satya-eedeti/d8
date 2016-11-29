<?php
namespace Drupal\training\Controller;

use Drupal\Core\Database\Driver\mysql\Connection;
use Drupal\core\Controller\ControllerBase;
use Symfony\Component\DependencyInjaection\ContainerInterface;

class NodeListingController extends ControllerBase{
  private $connection;
  // Constructor.
  /*public function __construct(Connection $connection) {

  }*/
  public function content() {
    return array(
      'markup' => 'home',
    );
  }
}

/*public static function create(ContainerInterface $container) {
	return new static(
		$container->get('database'),
		$container->get('logger.dblog'),
	);
}*/
