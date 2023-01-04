<?php

namespace Drupal\banner_module\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Defines the slide entity.
 *
 * @ContentEntityType(
 *      id = "slide",
 *      label = @Translation("slide"),
 *      admin_permission = "administer site configuration",
 *      base_table = "slide",
 *      entity_keys = {
 *          "id" = "id",
 *          "uuid" = "uuid",
 *          "label" = "title"
 *      },
 * )
 */

class Slide extends ContentEntityBase implements ContentEntityInterface
{
    use EntityChangedTrait;

    public static function baseFieldDefinitions(EntityTypeInterface $entity_type)
    {
        $fields = parent::baseFieldDefinitions($entity_type);

        $fields['title'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Slide Title'))
            ->setDescription(t('Title of the slide'))
            ->setDisplayOptions('form', [
                'weight' => 1
            ]);

        $fields['description'] = BaseFieldDefinition::create('text')
            ->setLabel(t('Slide Description'))
            ->setDescription(t('Description of the slide'))
            ->setDisplayOptions('form', [
                'type' => 'string_textfield',
                'weight' => 2,
            ]);

        $fields['position_title'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Position Title'))
            ->setDescription('Left || Center || Right');

        $fields['view_mode'] = BaseFieldDefinition::create('string')
            ->setLabel(t('View mode'))
            ->setDescription(t('Light || Dark'));

        $fields['image'] = BaseFieldDefinition::create('image')
            ->setLabel(t('Image'))
            ->setDescription(t('Slide Image'))
            ->setDisplayOptions('form', [
                'type' => 'image_image',
                'weight' => 5,
            ]);


        $fields['action_button_label'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Action Button Label'))
            ->setDescription(t('Label in Button reference to a link'));

        $fields['action_link'] = BaseFieldDefinition::create('uri')
            ->setLabel(t('Action Link'))
            ->setDescription(t('Link of Action button'));

        //  Timestamps
        $fields['created'] = BaseFieldDefinition::create('created')
            ->setLabel(t('Created'))
            ->setDescription(t('The time that the entity was created.'));

        $fields['changed'] = BaseFieldDefinition::create('changed')
            ->setLabel(t('Changed'))
            ->setDescription(t('The time that the entity was last edited.'));

        return $fields;
    }

    public function getSlideTitle()
    {
        return $this->get('title')->value;
    }
    public function setSlideTitle($title)
    {
        $this->set('title', $title);
        return $this;
    }

    public function getSlideDescription()
    {
        return $this->get('description')->value;
    }
    public function setSlideDescription($description)
    {
        $this->set('description', $description);
        return $this;
    }

    public function getPositionTitle()
    {
        return $this->get('position_title')->value;
    }
    public function setPositionTitle($position)
    {
        $this->set('position_title', $position);
        return $this;
    }

    public function getViewMode()
    {
        return $this->get('view_mode')->value;
    }
    public function setViewMode($viewMode)
    {
        $this->set('view_mode', $viewMode);
        return $this;
    }

    public function getImage()
    {
        return $this->get('image')->value;
    }
    public function setImage($image)
    {
        $this->set('image', $image);
        return $this;
    }

    public function getActionButtonLabel()
    {
        return $this->get('action_button_label')->value;
    }
    public function setActionButtonLabel($actionButtonLabel)
    {
        $this->set('action_button_label', $actionButtonLabel);
        return $this;
    }

    public function getActionLink()
    {
        return $this->get('action_link')->value;
    }
    public function setActionLink($actionLink)
    {
        $this->set('action_link', $actionLink);
        return $this;
    }
}
