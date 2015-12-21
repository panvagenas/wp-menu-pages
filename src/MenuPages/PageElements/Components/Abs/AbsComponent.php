<?php

namespace Pan\MenuPages\PageElements\Components\Abs;

use Pan\MenuPages\PageElements\Abs\AbsElement;
use Pan\MenuPages\PageElements\Containers\Abs\AbsComponentsContainer;
use Pan\MenuPages\Templates\Twig;

abstract class AbsComponent extends AbsElement {
    /**
     * @var AbsComponentsContainer
     */
    protected $container;

    protected $templatesDir = 'components';

    public function __construct( AbsComponentsContainer $container ) {
        $this->container = $container;
        $this->container->attachComponent($this);
    }

    /**
     * @return Twig
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getTwig() {
        return $this->container->getTwig();
    }

    public function getMarkUp( $echo = false ) {
        $markup = $this->getTwig()
                       ->getTwigEnvironment()
                       ->render( $this->getTemplateName(), [ 'el' => $this ] );

        if ( $echo ) {
            echo $markup;
        }

        return $markup;
    }
}