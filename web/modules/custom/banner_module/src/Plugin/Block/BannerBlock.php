<?php

namespace Drupal\banner_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Banner Block
 * 
 * @Block(
 *      id = "banner_block",
 *      admin_label = @Translation("Block to show Banner"),
 * )
 */
class BannerBlock extends BlockBase
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
        array $configuration,
        $plugin_id,
        $plugin_definition,
        ContainerInterface $container
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
        return [
            '#markup' => $this->t('This is my Banner Block')
        ];
    }
}
