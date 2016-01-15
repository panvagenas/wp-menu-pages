<?php

namespace Pan\MenuPages\PageElements\Containers;

use Pan\MenuPages\PageElements\Containers\Abs\AbsCnrComponents;
use Pan\MenuPages\Pages\Abs\AbsMenuPage;

class CnrCollapsible extends AbsCnrComponents {
    protected $templateName = 'collapsible.twig';
    /**
     * @var string
     */
    protected $title = '';

    public function __construct( AbsMenuPage $menuPage, $position, $title ) {
        parent::__construct( $menuPage, $position );
        $this->setTitle($title);
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
}