<?php

namespace Drupal\banner_module\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Defines the bannerset entity.
 *
 * @ingroup bannerset
 *
 * @ContentEntityType(
 *   id = "bannerset",
 *   label = @Translation("Bannerset"),
 *   base_table = "bannerset",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *   },
 * )
 */

class Bannerset extends ContentEntityBase implements ContentEntityInterface
{
    public static function baseFieldDefinitions(EntityTypeInterface $entity_type)
    {

        // Standard field, used as unique if primary index.
        $fields['id'] = BaseFieldDefinition::create('integer')
            ->setLabel(t('ID'))
            ->setDescription(t('The ID of the Bannerset entity.'))
            ->setReadOnly(TRUE);

        // Standard field, unique outside of the scope of the current project.
        $fields['uuid'] = BaseFieldDefinition::create('uuid')
            ->setLabel(t('UUID'))
            ->setDescription(t('The UUID of the Bannerset entity.'))
            ->setReadOnly(TRUE);

        $fields['maximum_image'] = BaseFieldDefinition::create('integer')
            ->setLabel(t('Maximum Image'))
            ->setDescription(t('Maximum image contained in Bannerset'));

        return $fields;
    }
}
