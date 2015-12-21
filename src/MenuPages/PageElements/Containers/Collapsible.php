<?php

namespace Pan\MenuPages\PageElements\Containers;

use Pan\MenuPages\PageElements\Components\Abs\AbsComponent;
use Pan\MenuPages\PageElements\Containers\Abs\AbsComponentsContainer;
use Pan\MenuPages\Pages\Abs\AbsMenuPage;

class Collapsible extends AbsComponentsContainer {
    protected $body = [];
    protected $footer = [];
    protected $templateName = 'collapsible.twig';
    /**
     * @var string
     */
    protected $title = '';

    public function __construct( AbsMenuPage $menuPage, $position, $title ) {
        parent::__construct( $menuPage, $position );
        $this->setTitle($title);
    }

    public function attachComponent( AbsComponent $component ) {
        $this->body[] = $component;
        return parent::attachComponent( $component );
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <Panagiotis.Vagenas@interactivedata.com>
     * @see    Collapsible::$title
     * @codeCoverageIgnore
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return $this
     * @author Panagiotis Vagenas <Panagiotis.Vagenas@interactivedata.com>
     * @codeCoverageIgnore
     */
    public function setTitle( $title ) {
        $this->title = (string) $title;

        return $this;
    }

    /**
     * @return mixed
     * @author Panagiotis Vagenas <Panagiotis.Vagenas@interactivedata.com>
     * @see    Collapsible::$body
     * @codeCoverageIgnore
     */
    public function getBody() {
        return $this->body;
    }

    /**
     * @param mixed $body
     *
     * @return $this
     * @author Panagiotis Vagenas <Panagiotis.Vagenas@interactivedata.com>
     * @codeCoverageIgnore
     */
    public function setBody( $body ) {
        $this->body = $body;

        return $this;
    }

    /**
     * @return mixed
     * @author Panagiotis Vagenas <Panagiotis.Vagenas@interactivedata.com>
     * @see    Collapsible::$footer
     * @codeCoverageIgnore
     */
    public function getFooter() {
        return $this->footer;
    }

    /**
     * @param mixed $footer
     *
     * @return $this
     * @author Panagiotis Vagenas <Panagiotis.Vagenas@interactivedata.com>
     * @codeCoverageIgnore
     */
    public function setFooter( $footer ) {
        $this->footer = $footer;

        return $this;
    }
}