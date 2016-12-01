<?php

namespace Drupal\training\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Database\Driver\mysql\Connection;

/**
 * Provides a 'NodeTitlesBlock' block.
 *
 * @Block(
 *  id = "node_titles_block",
 *  admin_label = @Translation("Node titles block"),
 * )
 */
class NodeTitlesBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Drupal\Core\Database\Driver\mysql\Connection definition.
   *
   * @var Drupal\Core\Database\Driver\mysql\Connection
   */
  protected $database;
  /**
   * Construct.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param string $plugin_definition
   *   The plugin implementation definition.
   */
  public function __construct(
        array $configuration,
        $plugin_id,
        $plugin_definition,
        Connection $database
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->database = $database;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('database')
    );
  }



  /**
   * {@inheritdoc}
   */
  public function build() {
    $nodeids = $this->database->select('node_field_data', 'n')
    ->fields('n', array('nid', 'title'))
    ->range(0, 3)
    ->orderby('created', 'DESC')
    ->execute()
    ->fetchAll();
    $titletext = "";
    $nids = [];
    foreach ($nodeids as $title) {
      $titletext_dummy = $title->title;
      $titletext .= $titletext_dummy ." <br/> ";
      //$nids[] = 'node:' . $title->nid; // if we add node_list arg as below, then no need for individual nodes, it will tc.
    }
    $nids[] = 'node_list';
    $build = [];
    $build['node_titles_block']['#markup'] = $titletext;
    $build['node_titles_block']['#cache']['tags'] = $nids;

    return $build;
  }

}
