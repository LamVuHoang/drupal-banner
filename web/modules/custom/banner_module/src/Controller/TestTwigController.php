<?php

/**
 * @file
 * Contains \Drupal\test_twig\Controller\TestTwigController.
 */

namespace Drupal\banner_module\Controller;

use Drupal\Core\Controller\ControllerBase;

class TestTwigController extends ControllerBase
{
    public function test()
    {
        return [
            '#theme' => 'my_template',
            '#test_var' => $this->t('Test Value'),
        ];
    }

    public function another()
    {
        return [
            '#markup' => $this->t('I just want to show up')
        ];
    }
}
