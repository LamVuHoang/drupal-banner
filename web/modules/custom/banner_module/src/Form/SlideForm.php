<?php

namespace Drupal\banner_module\Form;

use Drupal\Component\Datetime\TimeInterface;
use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Entity\EntityRepositoryInterface;
use Drupal\Core\Entity\EntityTypeBundleInfoInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\SubformState;
use Drupal\Core\Messenger\MessengerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Form for Creating and Editing Slide
 */
class SlideForm extends ContentEntityForm
{
    /**
     * @var Drupal\Core\Messenger\MessengerInterface
     */
    protected $messenger;

    public function __construct(
        EntityRepositoryInterface $entityRepositoryInterface,
        EntityTypeBundleInfoInterface $entityTypeBundleInfoInterface,
        TimeInterface $time,
        MessengerInterface $messenger
    ) {
        parent::__construct(
            $entityRepositoryInterface,
            $entityTypeBundleInfoInterface,
            $time
        );
        $this->messenger = $messenger;
    }

    public static function create(ContainerInterface $container)
    {
        return new static(
            $container->get('entity.repository'),
            $container->get('entity_type.bundle.info'),
            $container->get('datetime.time'),
            $container->get('messenger')
        );
    }
    /**
     * {@inheritdoc}
     */
    public function form(
        array $form,
        FormStateInterface $form_state
    ) {
        $form = parent::form($form, $form_state);

        $form['title'] = [
            '#type' => 'textfield',
            '#required' => TRUE,
            '#title' => $this->t('Title'),
            '#default_value' => $this->entity->getSlideTitle()
        ];

        $form['description'] = [
            '#type' => 'textarea',
            '#rows' => 3,
            '#title' => $this->t('Description'),
            '#default_value' => $this->entity->getSlideDescription()
        ];

        $positionField = [
            'center' => $this->t('Center'),
            'left' => $this->t('Left'),
            'right' => $this->t('Right')
        ];

        $form['position_title'] = [
            '#type' => 'radios',
            '#title' => $this->t('Text position'),
            '#default_value' => $this->entity->getPositionTitle() ?? 'center',
            '#options' => $positionField,
        ];

        $viewMode = [
            'light' => $this->t('Light'),
            'dark' => $this->t('Dark')
        ];
        $form['view_mode'] = [
            '#type' => 'radios',
            '#title' => $this->t('Light/Dark mode'),
            '#default_value' => $this->entity->getViewMode() ?? 'light',
            '#options' => $viewMode,
        ];

        $form['image'] = [
            '#type' => 'managed_file',
            '#title' => $this->t('Image'),
            '#required' => TRUE,
            '#upload_validators' => array(
                'file_validate_extensions' => array('gif png jpg jpeg'),
                'file_validate_size' => array(10000000),
            ),
            '#upload_location' => 'public://' . date("Y-m"),
            '#default_value' => array($this->entity->getImageFid()),

            '#ajax' => [
                'callback' => [$this, 'previewBannerSlideCallback'],
                'wrapper' => 'preview-banner-slide-wrapper'
            ],
        ];

        $form['preview_banner_slide'] = [
            '#type' => 'hidden',
            '#attributes' => [
                'id' => 'preview-banner-slide-wrapper'
            ],
            '#open' => TRUE
        ];

        if ($form_state->getValue('image')) {
            $form['preview_banner_slide']['#type'] = 'details';
            $form['preview_banner_slide']['#title'] = 'Preview';
            $form['preview_banner_slide']['#data'] = [
                '#process' => [[
                    get_class($this),
                    'processPreviewBannerSlide'
                ]],
            ];
        }

        $form['image_alt'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Image alt'),
            '#default_value' => $this->entity->getImageAlt()
        ];

        $form['action_button_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Action button'),
            '#required' => TRUE,
            '#placeholder' => $this->t('Button label'),
            '#default_value' => $this->entity->getActionButtonLabel()
        ];

        $form['action_link'] = [
            '#type' => 'url',
            '#placeholder' => $this->t('Action link'),
            '#required' => TRUE,
            '#default_value' => $this->entity->getActionLink()
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        array $form,
        FormStateInterface $form_state
    ) {
        $entity = $this->entity;
        $status = parent::save($form, $form_state);

        switch ($status) {
            case SAVED_NEW:
                $this->messenger->addMessage($this->t('Created the %label Slide.', [
                    '%label' => $entity->label(),
                ]));
                break;
            default:
                $this->messenger->addMessage($this->t('Saved the %label Slide.', [
                    '%label' => $entity->label(),
                ]));
        }
        $form_state->setRedirect(
            'entity.slide.canonical',
            ['slide' => $entity->id()]
        );
    }

    public function validateForm(
        array &$form,
        FormStateInterface $form_state
    ) {
        if (strlen($form_state->getValue('title')) > 100) {
            $form_state->setErrorByName('title', $this->t('Title should smaller than 100 chars'));
        }

        if (strlen($form_state->getValue('description')) > 255) {
            $form_state->setErrorByName('description', $this->t('Description should smaller than 255 chars'));
        }

        parent::validateForm($form, $form_state);
    }

    public function previewBannerSlideCallback(
        $form,
        FormStateInterface $form_state
    ) {
        return $form['preview_banner_slide'];
    }

    public static function processPreviewBannerSlide(
        array &$element,
        FormStateInterface $form_state
    ) {
        $plugin = $element['#plugin'];
        $subform_state = SubformState::createForSubform(
            $element,
            $form_state->getCompleteForm(),
            $form_state
        );
        return $plugin->buildConfigurationForm($element, $subform_state);
    }
}
