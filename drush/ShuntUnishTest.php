<?php

/**
 * @file
 * Contains \Unish\ShuntUnishTest.
 */

namespace Unish;

if (class_exists('Unish\CommandUnishTestCase')) {

  /**
   * Unish tests for the Shunt module.
   */
  class ShuntUnishTest extends CommandUnishTestCase {

    /**
     * Tests the Shunt module's Drush commands.
     */
    public function testShuntDrushCommands() {
      // Install a Drupal 8 sandbox using the testing profile.
      $sites = $this->setUpDrupal(1, TRUE, 8, 'testing');
      $options = array('root' => $this->webroot(), 'uri' => key($sites));

      // Symlink the Shunt module into the sandbox.
      $shunt_directory = dirname(__DIR__);
      symlink($shunt_directory, $this->webroot() . '/modules/shunt');

      // Enable the Shunt modules.
      $this->drush('pm-enable', array(
        'shunt',
        'shuntexample',
      ), $options + array('skip' => NULL, 'yes' => NULL));

      // Test shunt-list command.
      $this->drush('shunt-list', array(), $options + array('format' => 'json'));
      $output = $this->getOutput();
      $this->assertJsonStringEqualsJsonString(json_encode(array(
        'shunt' => array(
          'name' => 'shunt',
          'provider' => 'shunt',
          'description' => 'Default shunt. No built-in behavior.',
          'status' => 'Disabled',
        ),
        'shuntexample' => array(
          'name' => 'shuntexample',
          'provider' => 'shuntexample',
          'description' => 'Display a fail whale at /shuntexample.',
          'status' => 'Disabled',
        )
      )), $output);
    }
  }

}
