<?php

namespace Drupal\banner_module\Form;

use Drupal\Component\Datetime\TimeInterface;
use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Entity\EntityRepositoryInterface;
use Drupal\Core\Entity\EntityTypeBundleInfoInterface;
use Drupal\Core\Form\FormStateInterface;
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
        FormStateInterface $formStateInterface
    ) {
        $form = parent::form($form, $formStateInterface);

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

        $form['action_button_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Action button'),
            '#placeholder' => $this->t('Button label'),
            '#default_value' => $this->entity->getActionButtonLabel()
        ];

        $form['action_link'] = [
            '#type' => 'url',
            '#placeholder' => $this->t('Action link'),
            '#default_value' => $this->entity->getActionLink()
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        array $form,
        FormStateInterface $formStateInterface
    ) {
        $entity = $this->entity;
        $status = parent::save($form, $formStateInterface);

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
        $formStateInterface->setRedirect(
            'entity.slide.canonical',
            ['slide' => $entity->id()]
        );
    }
}
