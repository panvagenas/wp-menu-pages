<?php

namespace Pan\MenuPages\PageElements\Containers;

use Pan\MenuPages\PageElements\Components\Abs\AbsComponent;
use Pan\MenuPages\PageElements\Containers\Abs\AbsComponentsContainer;
use Pan\MenuPages\Pages\Abs\AbsMenuPage;

class Collapsible extends AbsComponentsContainer {
    const BLOCK_BODY = 'body';
    const BLOCK_FOOTER = 'footer';

    protected $body = [];
    protected $footer = [];
    protected $templateName = 'collapsible.twig';
    /**
     * @var string
     */
    protected $title = '';

    public function __construct( AbsMenuPage $menuPage, $position, $title ) {
        parent::__construct( $menuPage, $position );
        $this->title = $this->setTitle($title);
    }

    public function attachComponent( AbsComponent $component, $position ) {
        if(!$this->isValidPosition($position, true)){
            return false;
        }

        parent::attachComponent($component);

        if($position === self::BLOCK_BODY){
            $this->body[$component->getHashId()] = $component;
        } elseif ($position === self::BLOCK_FOOTER){
            $this->footer[$component->getHashId()] = $component;
        }

        return true;
    }

    protected function hasComponent( AbsComponent $component, $position ) {
        if(parent::hasComponent($component)){
            return true;
        }

        if($position === self::BLOCK_BODY){
            return array_key_exists($component->getHashId(), $this->body);
        }

        if($position === self::BLOCK_FOOTER) {
            return array_key_exists( $component->getHashId(), $this->footer );
        }

        return new \WP_Error('Invalid position');
    }

    protected function isValidPosition($position, $allowFail = false){
        if(in_array($position, [self::BLOCK_BODY, self::BLOCK_FOOTER], true)){
            return true;
        }

        if($allowFail){
            return false;
        }

        throw new \InvalidArgumentException('Invalid $position');
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