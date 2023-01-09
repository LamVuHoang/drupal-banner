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
        $ids = $this->entityTypeManager()
            ->getStorage('slide')->getQuery()->execute();
        $entity = $this->entityTypeManager()
            ->getStorage('slide')->loadMultiple($ids);

        return [
            '#theme' => 'test',
            '#entity' => $entity,
        ];
    }

    public function another()
    {
        return [
            '#markup' => $this->t('I just want to show up')
        ];
    }
}
