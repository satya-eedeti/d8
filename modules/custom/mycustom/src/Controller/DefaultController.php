<?php
namespace Drupal\mycustom\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\NodeInterface;
use Drupal\Core\JsonResponse;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Database\Driver\mysql\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class DefaultController.
 *
 * @package Drupal\mycustom\Controller
 */
class DefaultController extends ControllerBase {
  private $connection;
  public function __construct(Connection $connection) {
    $this->connection = $connection;
  }
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database'),
      $container->get('logger.dblog')
    );
  }
  /**
   * Mycontrol.
   *
   * @return string
   *   Return Hello string.
   */
  public function mycontrol() {
    $data = $this->connection->select('node', 'n')->fields('n', array())->execute();
    $header = array('nid', 'vid', 'type', 'uuid', 'language');
    $body = array();
    while ($row = $data->fetchAssoc()) {
      /*print_r($row);*/
      $body[] = $row;
    }
    $table = array(
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $body
    );
    //$markup = drupal_render($table);
    return $table;
  }
  /**
   * Mycontrol2.
   *
   * @return string
   *   Return Hello string.
   */
  public function mycontrol2() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: mycontrol2')
    ];
  }
  /**
   * Hello.
   *
   * @return string
   *   Return Hello string.
   */
  public function hello($name) {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: hello with parameter(s): $name'),
    ];
  }
  public function hello2(NodeInterface $node) {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: hello with parameter(s): ') . print_r(json_encode($node), TRUE),
    ];
    //return new JsonResponse($node);
  }

  public function customAccess() {
    return AccessResult::allowed();
  }
}
