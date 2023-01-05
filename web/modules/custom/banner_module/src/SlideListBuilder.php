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
        $header['id'] = $this->t('Thumbnail');
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

        $row['id'] = $entity->id();
        $row['title'] = $entity->toLink();
        $row['changed'] = $entity->getUpdateTimeAgo();
        return $row + parent::buildRow($entity);
    }
}
