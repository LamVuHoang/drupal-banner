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
        $abc = [
            'a', 'b', 'c'
        ];
        $ids = $this->entityTypeManager()
            ->getStorage('slide')->getQuery()->execute();
        $entity = $this->entityTypeManager()
            ->getStorage('slide')->loadMultiple($ids);
        // $database = \Drupal::database();
        // $entity = 

        return [
            '#theme' => 'test',
            '#entity' => $entity,
            '#abc' => $abc
        ];
    }

    public function another()
    {
        return [
            '#markup' => $this->t('I just want to show up')
        ];
    }
}
