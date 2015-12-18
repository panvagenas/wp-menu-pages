<?php

namespace Pan\MenuPages\PageElements\Containers\Abs;

use Pan\MenuPages\Ifc\IfcDisplayable;
use Pan\MenuPages\PageElements\Abs\AbsElement;

abstract class AbsContainer extends AbsElement implements IfcDisplayable {
    const POSITION_MAIN = 'main';
    const POSITION_ASIDE = 'aside';

    protected $templatesDir = 'containers';
    protected $templateName = '';

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