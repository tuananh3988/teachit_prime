<?php
/**
 * @file
 * portfolio_content.features.inc
 */

/**
 * Implements hook_node_info().
 */
function portfolio_content_node_info() {
  $items = array(
    'portfolio' => array(
      'name' => t('Portfolio'),
      'base' => 'node_content',
      'description' => t('Portfolio content.'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  return $items;
}
