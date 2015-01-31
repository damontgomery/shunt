<?php

/**
 * @file
 * Definition of Drupal\shunt\Plugin\views\argument\ShuntStatus.
 */

namespace Drupal\shunt\Plugin\views\argument;

use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Plugin\views\argument\ArgumentPluginBase;

/**
 * Argument handler for shunts.
 *
 * @ingroup views_argument_handlers
 *
 * @ViewsArgument("shunt_status")
 */
class ShuntStatus extends ArgumentPluginBase {

  /**
   * {@inheritdoc}
   */
  protected function defineOptions() {
    $options = parent::defineOptions();
    $options['must_not_be'] = ['default' => FALSE];
    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);

    unset($form['more']);
    unset($form['description']);
    unset($form['no_argument']);
    unset($form['default_action']);
    unset($form['exception']);
    unset($form['default_argument_skip_url']);
    unset($form['argument_present']);
    unset($form['title_enable']);
    unset($form['title']);
    unset($form['specify_validation']);
    unset($form['validate']);

    $form['shunt'] = [
      '#type' => 'select',
      '#title' => $this->t('Shunt'),
      '#options' => $this->shuntOptionList(),
      '#weight' => -10,
    ];
    $form['status'] = [
      '#type' => 'radios',
      '#title' => $this->t('Status'),
      '#options' => [
        'enabled' => $this->t('Enabled'),
        'disabled' => $this->t('Disabled'),
      ],
      '#weight' => -9,
    ];
  }

  /**
   * Returns a list of shunts formatted as a FAPI #options value.
   *
   * @return array
   *   An associative array whose keys are shunt IDS with values of the
   *   corresponding shunt labels.
   */
  protected function shuntOptionList() {
    $ids = \Drupal::entityQuery('shunt')->execute();
    /** @var \Drupal\shunt\Entity\Shunt[] $shunts */
    $shunts = entity_load_multiple('shunt', $ids);
    $options = [];
    foreach ($shunts as $id => $shunt) {
      $options[$id] = $shunt->label();
    }
    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function query($group_by = FALSE) {}

}
