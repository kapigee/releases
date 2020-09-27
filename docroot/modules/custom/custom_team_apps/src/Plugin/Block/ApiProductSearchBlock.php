<?php

namespace Drupal\custom_team_apps\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'ApiProductSearchBlock' block.
 *
 * @Block(
 *  id = "api_search_product_block",
 *  admin_label = @Translation("Api Product Search Block"),
 * )
 */
class ApiProductSearchBlock extends BlockBase {

    /**
     * {@inheritdoc}
     */
    public function build() {

        $form = \Drupal::formBuilder()->getForm('\Drupal\custom_team_apps\Form\SearchExposeForm');
        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheMaxAge() {
        return 0;
    }

}