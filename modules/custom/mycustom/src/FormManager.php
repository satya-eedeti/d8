<?php
namespace Drupal\mycustom;

use Drupal\Core\Database\Connection;

class FormManager {
	private $connection;
	public function __construct(Connection $connection) {
		$this->connection = $connection;
	}

	public function fetchData() {
		return $this->connection->select('custom_form', 'cf')
		->fields('cf', array())
		->range(0, 3)
		->execute()
		->fetchAll();
	}
	public function addData(String $firstname, String $lastname) {
		$this->connection->insert('custom_form')
		->fields(array(
			'firstname' => $firstname, 'lastname' => $lastname,
		))
		->execute();
	}
	public static function create(ContainerInterface $container) {
		return new static(
			$container->get('database')
		);
	}
}