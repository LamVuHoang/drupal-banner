<?php

namespace Drupal\banner_module;

use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

class SlideListBuilder extends EntityListBuilder
{
    /**
     * {@inheritdoc}
     */
    public function buildHeader()
    {
        $header['thumbnail'] = $this->t('Thumbnail');
        $header['title'] = $this->t('Title');
        $header['changed'] = $this->t('Updated');
        $header['operations'] = $this->t('Action');
        return $header;
    }

    /**
     * @param \Drupal\Core\Entity\EntityInterface $entity
     */
    public function buildRow(EntityInterface $entity)
    {

        if ($entity->getImageUri()) {
            $row['thumbnail']['data'] = [
                '#theme' => 'image_style',
                '#style_name' => 'thumbnail',
                '#uri' => $entity->getImageUri(),
                '#height' => 50,
            ];
        } else {
            $row['thumbnail'] = [];
        }
        $row['title'] = $entity->toLink();
        $row['changed'] = $entity->getUpdateTimeAgo();
        return $row + parent::buildRow($entity);
    }
}
