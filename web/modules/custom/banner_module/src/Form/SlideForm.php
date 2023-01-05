<?php

namespace Drupal\banner_module\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form for Creating and Editing Slide
 */
class SlideForm extends ContentEntityForm
{
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
        ];

        $form['description'] = [
            '#type' => 'textarea',
            '#rows' => 3,
            '#title' => $this->t('Description')
        ];

        $positionField = [
            'center' => $this->t('Center'),
            'left' => $this->t('Left'),
            'right' => $this->t('Right')
        ];

        $form['position_title'] = [
            '#type' => 'radios',
            '#title' => $this->t('Text position'),
            '#default_value' => $positionField['center'],
            '#options' => $positionField,
        ];

        $viewMode = [
            'light' => $this->t('Light'),
            'dark' => $this->t('Dark')
        ];
        $form['view_mode'] = [
            '#type' => 'radios',
            '#title' => $this->t('Light/Dark mode'),
            '#default_value' => $viewMode['light'],
            '#options' => $viewMode,
        ];

        $form['action_button_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Action button'),
            '#description' => $this->t('Button label')
        ];

        $form['action_link'] = [
            '#type' => 'url',
            '#description' => $this->t('Action link')
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
                $this->messenger()->addMessage($this->t('Created the %label Slide.', [
                    '%label' => $entity->label(),
                ]));
                break;
            default:
                $this->messenger()->addMessage($this->t('Saved the %label Slide.', [
                    '%label' => $entity->label(),
                ]));
        }
        $formStateInterface->setRedirect(
            'entity.slide.canonical',
            ['slide' => $entity->id()]
        );
    }
}
