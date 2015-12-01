<?php

namespace Pan\MenuPages\PageComponents\Abs;

use Pan\MenuPages\Templates\Twig;
use Pan\MenuPages\Trt\TrtIdentifiable;
use Pan\MenuPages\MenuPage;

abstract class AbsMenuPageComponent {
    use TrtIdentifiable;
    /**
     * @var MenuPage
     */
    protected $menuPage;

    public function __construct( MenuPage $menuPage ) {
        $this->menuPage = $menuPage;
        $this->menuPage->attachComponent($this);
    }

    public function getOptions(){
        return $this->menuPage->getOptions();
    }

    /**
     * @return Twig
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getTwig(){
        return $this->menuPage->getTwig();
    }
}