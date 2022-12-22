<?php

/**
 * @file
 * Contains \Drupal\test_twig\Controller\TestTwigController.
 */

namespace Drupal\banner_module\Controller;

use Drupal\Core\Controller\ControllerBase;

class BannerController extends ControllerBase
{
    public function banner()
    {
        return [
            '#theme' => 'banner',
            '#position' => $this->t('Left')
        ];
    }
}
