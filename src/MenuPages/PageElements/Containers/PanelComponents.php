<?php

namespace Pan\MenuPages\PageElements\Containers;

use Pan\MenuPages\PageElements\Containers\Abs\AbsComponentsContainer;

class PanelComponents extends AbsComponentsContainer {
    /**
     * @var string
     */
    protected $title = '';
    protected $templateName = 'panel-components.twig';

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    PanelComponents::$title
     * @codeCoverageIgnore
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @codeCoverageIgnore
     */
    public function setTitle( $title ) {
        $this->title = $title;

        return $this;
    }
}