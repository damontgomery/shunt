<?php

/**
 * @file
 * Provides views data for the Shunt module.
 */

/**
 * Implements hook_views_data().
 */
function shunt_views_data() {
  $data['views']['shunt'] = array(
    'title' => t('Shunt status'),
    'help' => t('A shunt status.'),
    'argument' => array(
      'id' => 'shunt_status',
    ),
  );
  return $data;
}
