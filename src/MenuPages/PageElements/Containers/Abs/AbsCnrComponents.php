<?php

namespace Pan\MenuPages\PageElements\Containers\Abs;

use Pan\MenuPages\PageElements\Components\Abs\AbsCmp;

abstract class AbsCnrComponents extends AbsCnr {
    const CNR_HEAD = 'head';

    const CNR_BODY = 'body';

    const CNR_FOOTER = 'footer';

    protected $components = [
        self::CNR_HEAD   => [ ],
        self::CNR_BODY   => [ ],
        self::CNR_FOOTER => [ ],
    ];

    public function attachComponent( AbsCmp $component, $position = self::CNR_BODY ) {
        if ( $this->isProperPosition( $position ) && ! $this->hasComponent( $component, $position ) ) {
            $this->components[ $position ][ $component->getHashId() ] = $component;
        }

        return $this;
    }

    protected function isProperPosition( $position ) {
        return in_array( $position, [ self::CNR_BODY, self::CNR_HEAD, self::CNR_FOOTER ], true );
    }

    protected function hasComponent( AbsCmp $component, $position ) {
        return $this->isProperPosition( $position )
               && in_array( $component->getHashId(), $this->components[ $position ] );
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

    public function getComponentsFlat() {
        $r = [ ];
        foreach ( $this->components as $context ) {
            /** @var AbsCmp $component */
            foreach ( $context as $component ) {
                $r[ $component->getHashId() ] = $component;
            }
        }

        return $r;
    }
}