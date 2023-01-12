<?php

namespace Drupal\banner_module\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\file\FileInterface;

/**
 * Represents a Slide entity.
 */
interface SlideInterface extends ContentEntityInterface, EntityChangedInterface
{
    /**
     * Get and Set the Slide title
     */
    public function getSlideTitle(): string;
    public function setSlideTitle(string $title): SlideInterface;


    /**
     * Get and Set the Slide description.
     */
    public function getSlideDescription(): string;
    public function setSlideDescription(string $description): SlideInterface;

    /**
     * Get and Set the Slide position title
     */
    public function getPositionTitle(): string;
    public function setPositionTitle(string $position): SlideInterface;

    /**
     * Get and Set the Slide view mode
     */
    public function getViewMode(): string;
    public function setViewMode(string $position): SlideInterface;

    /**
     * Gets and Set the Slide image.
     *
     * @return \Drupal\file\FileInterface
     */
    public function getImage(): FileInterface;
    
    /**
     * Sets the Slide image.
     *
     * @param int $image
     *
     * @return \Drupal\banner_module\Entity\SlideInterface
     * The called Slide entity.
     */
    public function setImage(int $image): SlideInterface;
}
