<?php

namespace Pan\MenuPages\PageElements\Components\Abs;

use Pan\MenuPages\Ifc\IfcDisplayable;
use Pan\MenuPages\PageElements\Abs\AbsElement;
use Pan\MenuPages\PageElements\Containers\Abs\AbsComponentsContainer;
use Pan\MenuPages\Templates\Twig;

abstract class AbsComponent extends AbsElement implements IfcDisplayable{
    /**
     * @var AbsComponentsContainer
     */
    protected $container;

    protected $templatesDir = 'components';
    protected $templateName = '';

    public function __construct( AbsComponentsContainer $container ) {
        parent::__construct( $container->getMenuPage() );
        $this->container = $container;
        $this->container->attachComponent($this);
    }

    /**
     * @return Twig
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getTwig() {
        return $this->menuPage->getTwig();
    }

    public function getMarkUp( $echo = false ) {
        $markup = $this->getTwig()
                       ->getTwigEnvironment()
                       ->render( $this->getTemplateName(), [ 'e' => $this ] );

        if ( $echo ) {
            echo $markup;
        }

        return $markup;
    }

    public function getTemplateName() {
        return $this->templatesDir . '/' . $this->templateName;
    }
}