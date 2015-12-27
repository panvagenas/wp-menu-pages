<?php

namespace Pan\MenuPages\PageElements\Containers\Abs;

use Pan\MenuPages\PageElements\Components\Abs\AbsComponent;

abstract class AbsComponentsContainer extends AbsContainer {

    protected $components = [
        self::EL_HEAD => [ ],
        self::EL_BODY => [ ],
        self::EL_FOOTER => [ ],
    ];

    public function attachComponent( AbsComponent $component, $position = self::EL_BODY ) {
        if ( $this->isProperPosition( $position ) && ! $this->hasComponent( $component, $position ) ) {
            $this->components[ $position ][ $component->getHashId() ] = $component;
        }

        return $this;
    }

    protected function hasComponent( AbsComponent $component, $position ) {
        return $this->isProperPosition( $position )
               && in_array( $component->getHashId(), $this->components[ $position ] );
    }

    protected function isProperPosition( $position ) {
        return in_array( $position, [ self::EL_BODY, self::EL_HEAD, self::EL_FOOTER ], true );
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

    public function getComponentsFlat(){
        $r = [];
        foreach ( $this->components as $context ) {
            /** @var AbsComponent $component */
            foreach ( $context as $component ) {
                $r[$component->getHashId()] = $component;
            }
        }

       return $r;
    }
}