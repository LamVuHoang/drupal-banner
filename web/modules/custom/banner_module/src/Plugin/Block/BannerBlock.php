<?php

namespace Drupal\banner_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Banner Block
 * 
 * @Block(
 *      id = "banner_block",
 *      admin_label = @Translation("Block to show Banner"),
 * )
 */
class BannerBlock extends BlockBase implements ContainerFactoryPluginInterface
{
    /**
     * @var \Drupal\Core\Entity\EntityTypeManagerInterface
     */
    protected $entityTypeManager;

    public function __construct(
        array $configuration,
        $plugin_id,
        $plugin_definition,
        EntityTypeManagerInterface $entityTypeManager
    ) {
        parent::__construct(
            $configuration,
            $plugin_id,
            $plugin_definition
        );
        $this->entityTypeManager = $entityTypeManager;
    }

    /**
     * {@inheritdoc}
     */
    public static function create(
        ContainerInterface $container,
        array $configuration,
        $plugin_id,
        $plugin_definition,
    ) {
        return new static(
            $configuration,
            $plugin_id,
            $plugin_definition,
            $container->get('entity_type.manager')
        );
    }

    public function build()
    {
        $ids = $this->entityTypeManager
            ->getStorage('slide')->getQuery()->execute();
        $entities = $this->entityTypeManager
            ->getStorage('slide')->loadMultiple($ids);
        return [
            '#theme' => 'banner',
            '#entities' => $entities
        ];
    }
}
