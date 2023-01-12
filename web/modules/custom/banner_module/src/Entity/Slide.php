<?php

namespace Drupal\banner_module\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\file\FileInterface;

/**
 * Defines the slide entity.
 *
 * @ContentEntityType(
 *      id = "slide",
 *      label = @Translation("Slide"),
 *      admin_permission = "administer site configuration",
 *      base_table = "slide",
 *      entity_keys = {
 *          "id" = "id",
 *          "label" = "title",
 *          "uuid" = "uuid",
 *          "label" = "title"
 *      },
 * 
 *      handlers = {
 *          "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *          "list_builder" = "Drupal\banner_module\SlideListBuilder",
 *          "form" = {
 *              "default" = "Drupal\banner_module\Form\SlideForm",
 *              "add" = "Drupal\banner_module\Form\SlideForm",
 *              "edit" = "Drupal\banner_module\Form\SlideForm",
 *              "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *          },
 *          "route_provider" = {
 *              "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider"
 *          },
 *      },
 * 
 *      links = {
 *          "canonical" = "/admin/structure/slide/{slide}",
 *          "add-form" = "/admin/structure/slide/add",
 *          "edit-form" = "/admin/structure/slide/{slide}/edit",
 *          "delete-form" = "/admin/structure/slide/{slide}/delete",
 *          "collection" = "/admin/structure/slide",
 *      },
 * 
 * )
 */

class Slide extends ContentEntityBase implements SlideInterface
{
    use EntityChangedTrait;

    public static function baseFieldDefinitions(EntityTypeInterface $entity_type)
    {
        $fields = parent::baseFieldDefinitions($entity_type);

        $fields['title'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Slide Title'))
            ->setDescription(t('Title of the slide'))
            ->setDisplayOptions('view', [
                'label' => 'above',
                'weight' => -5
            ])
            ->setSettings([
                'max_length' => 100
            ]);


        $fields['description'] = BaseFieldDefinition::create('text')
            ->setLabel(t('Slide Description'))
            ->setDescription(t('Description of the slide'))
            ->setDisplayOptions('view', [
                'label' => 'above',
            ])
            ->setSettings([
                'max_length' => 255
            ]);

        $fields['position_title'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Position Title'))
            ->setDescription('Position of the Slide title')
            ->setDisplayOptions('view', [
                'label' => 'above',
            ]);

        $fields['view_mode'] = BaseFieldDefinition::create('string')
            ->setLabel(t('View mode'))
            ->setDescription(t('Light || Dark'))
            ->setDisplayOptions('view', [
                'label' => 'above',
            ]);

        $fields['image'] = BaseFieldDefinition::create('image')
            ->setLabel(t('Image'))
            ->setDescription(t('Slide Image'))
            // ->setDisplayOptions('form', [
            //     'type' => 'image_image',
            //     'weight' => 5,
            // ])
            ->setDisplayOptions('view', [
                'label' => 'above'
            ]);


        $fields['action_button_label'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Action Button Label'))
            ->setDescription(t('Label in Button reference to a link'))
            ->setDisplayOptions('view', [
                'type' => 'string'
            ]);

        $fields['action_link'] = BaseFieldDefinition::create('uri')
            ->setLabel(t('Action Link'))
            ->setDescription(t('Link of Action button'))
            ->setDisplayOptions('view', [
                'label' => 'above',
            ]);

        //  Timestamps
        $fields['created'] = BaseFieldDefinition::create('created')
            ->setLabel(t('Created'))
            ->setDescription(t('The time that the entity was created.'));

        $fields['changed'] = BaseFieldDefinition::create('changed')
            ->setLabel(t('Changed'))
            ->setDescription(t('The time that the entity was last edited.'));

        return $fields;
    }

    public function getSlideTitle(): string
    {
        return $this->get('title')->value;
    }
    public function setSlideTitle(string $title): SlideInterface
    {
        $this->set('title', $title);
        return $this;
    }

    public function getSlideDescription(): string
    {
        return $this->get('description')->value;
    }
    public function setSlideDescription(string $description): SlideInterface
    {
        $this->set('description', $description);
        return $this;
    }

    public function getPositionTitle(): string
    {
        return $this->get('position_title')->value;
    }
    public function setPositionTitle(string $position): SlideInterface
    {
        $this->set('position_title', $position);
        return $this;
    }

    public function getViewMode(): string
    {
        return $this->get('view_mode')->value;
    }
    public function setViewMode(string $viewMode): SlideInterface
    {
        $this->set('view_mode', $viewMode);
        return $this;
    }

    /**
     * Get and Set Image values
     */
    public function getImage(): FileInterface
    {
        return $this->get('image')->entity;
    }
    public function setImage($image): SlideInterface
    {
        $this->set('image', $image);
        return $this;
    }
    public function getImageFid(): int|string
    {
        $img = $this->getImage();
        if ($img) return $img->fid->value;
        return '';
    }
    public function getImageUri(): string
    {
        $img = $this->getImage();
        if ($img) return $img->uri->value;
        return '';
    }

    public function getImageAlt(): string
    {
        $img = $this->getImage();
        if ($img) return $this->get('image')->alt;
        return '';
    }

    public function getRelativeUrl(string $size = 'large'): string
    {
        $img = $this->getImage();
        if ($img) {
            $style = $this->entityTypeManager()->getStorage('image_style')->load($size);
            return $style->buildUrl($this->getImageUri());
        }
        return '';
    }

    public function getActionButtonLabel(): string
    {
        return $this->get('action_button_label')->value;
    }
    public function setActionButtonLabel(string $actionButtonLabel): SlideInterface
    {
        $this->set('action_button_label', $actionButtonLabel);
        return $this;
    }

    public function getActionLink(): string
    {
        return $this->get('action_link')->value;
    }
    public function setActionLink(string $actionLink): SlideInterface
    {
        $this->set('action_link', $actionLink);
        return $this;
    }

    public function getChanged(): int
    {
        return $this->get('changed')->value;
    }
    public function setChanged(int $changed): SlideInterface
    {
        $this->set('changed', $changed);
        return $this;
    }

    public function getUpdateTimeAgo(): string
    {
        $timeDifferences = time() - $this->getChanged();

        if ($timeDifferences < 1) {
            return 'less than 1 second ago';
        }

        $condition = array(
            12 * 30 * 24 * 60 * 60  =>  'year',
            30 * 24 * 60 * 60       =>  'month',
            24 * 60 * 60            =>  'day',
            60 * 60                 =>  'hour',
            60                      =>  'minute',
            1                       =>  'second'
        );

        foreach ($condition as $timePeriod => $measurement) {
            $timeCategory = $timeDifferences / $timePeriod;

            if ($timeCategory >= 1) {
                $timeCategoryRounded = round($timeCategory);
                return $timeCategoryRounded . ' ' .
                    $measurement .
                    ($timeCategoryRounded > 1 ? 's' : '') .
                    ' ago';
            }
        }
    }
}
