<?php

namespace Drupal\banner_module\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Defines the banner entity.
 *
 * @ingroup banner
 *
 * @ContentEntityType(
 *   id = "banner",
 *   label = @Translation("Banner"),
 *   base_table = "banner",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *   },
 * )
 */

class Banner extends ContentEntityBase implements ContentEntityInterface
{
    public static function baseFieldDefinitions(EntityTypeInterface $entity_type)
    {

        // Standard field, used as unique if primary index.
        $fields['id'] = BaseFieldDefinition::create('integer')
            ->setLabel(t('ID'))
            ->setDescription(t('The ID of the Banner entity.'))
            ->setReadOnly(TRUE);

        // Standard field, unique outside of the scope of the current project.
        $fields['uuid'] = BaseFieldDefinition::create('uuid')
            ->setLabel(t('UUID'))
            ->setDescription(t('The UUID of the Banner entity.'))
            ->setReadOnly(TRUE);

        $fields['banner_title'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Banner Title'))
            ->setDescription(t('Title of the banner'));

        $fields['brief'] = BaseFieldDefinition::create('text')
            ->setLabel(t('Brief'))
            ->setDescription(t('Description for the banner'));

        $fields['position_title'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Button of Title'))
            ->setDescription('Left || Center || Right');

        // Entity Reference to Bannerset Entity
        $fields['bannerset_id'] = BaseFieldDefinition::create('entity_reference')
            ->setLabel(t('Bannerset ID Owner'))
            ->setDescription(t('This banner belong to which bannerset'))
            ->setSettings([
                'target_type' => 'bannerset',
                'default_value' => 1
            ]);

        $fields['bannerset_order'] = BaseFieldDefinition::create('integer')
            ->setLabel(t('Bannerset Order'))
            ->setDescription(t('The order of appearing in Order set'));

        $fields['button_label'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Button Label'))
            ->setDescription(t('Label in Button reference to a link'));

        $fields['content_link'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Content Link'))
            ->setDescription(t('Link to another site'));

        $fields['image_link'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Image Link'))
            ->setDescription(t('Image link of this banner'));

        return $fields;
    }
}
