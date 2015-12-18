<?php

namespace Pan\MenuPages\PageElements\Containers\Abs;

use Pan\MenuPages\PageElements\Components\Abs\AbsComponent;

abstract class AbsComponentsContainer extends AbsContainer {
    protected $components = [ ];

    public function attachComponent( AbsComponent $component ){
        if(!$this->hasComponent($component)){
            $this->components[$component->getHashId()] = $component;
        }

        return $this;
    }

    protected function hasComponent( AbsComponent $component ){
        return in_array($component->getHashId(), $this->components);
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    AbsContainer::$components
     * @codeCoverageIgnore
     */
    public function getComponents() {
        return $this->components;
    }
}