<?php

namespace Drupal\mycustom\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the mycustom module.
 */
class DefaultControllerTest extends WebTestBase {
  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name' => "mycustom DefaultController's controller functionality",
      'description' => 'Test Unit for module mycustom and controller DefaultController.',
      'group' => 'Other',
    );
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * Tests mycustom functionality.
   */
  public function testDefaultController() {
    // Check that the basic functions of module mycustom.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via App Console.');
  }

}
