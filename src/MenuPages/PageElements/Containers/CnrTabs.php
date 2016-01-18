<?php

namespace Pan\MenuPages\PageElements\Containers;

use Pan\MenuPages\Options;
use Pan\MenuPages\PageElements\Components\Abs\AbsCmp;
use Pan\MenuPages\PageElements\Components\CmpTab;
use Pan\MenuPages\PageElements\Components\CmpTabForm;
use Pan\MenuPages\PageElements\Containers\Abs\AbsCnrComponents;

class CnrTabs extends AbsCnrComponents {
    const CNR_TAB = 'tabs';

    protected $templateName = 'tabs.twig';
    protected $components = [
        self::CNR_HEAD   => [ ],
        self::CNR_BODY   => [ ],
        self::CNR_FOOTER => [ ],
        self::CNR_TAB    => [ ],
    ];

    protected $activeTab;

    public function addTab( $title, $active = true, $icon = '' ) {
        $tab = new CmpTabForm( $this, $title, $active, $icon );

        return $tab;
    }

    protected function isProperPosition( $position ) {
        return parent::isProperPosition( $position ) || $position === self::CNR_TAB;
    }

    public function attachComponent( AbsCmp $component, $position = self::CNR_BODY ) {
        // !FIXME We have to find a way to set a default active tab
        if ( $position === self::CNR_BODY && ! ( $component instanceof CmpTabForm || $component instanceof CmpTab ) ) {
            throw new \InvalidArgumentException( 'Component must be a tab instance' );
        }

        if($component instanceof CmpTabForm || $component instanceof CmpTab) {
            $storedActive = $this->getTabState( $component );

            if ( $storedActive === null ) {
                if ( $component->isActive() ) {
                    if ( ! $this->activeTab ) {
                        $this->activeTab = $component;
                    } else {
                        $component->setActive( false );
                    }
                }
            } elseif ( $storedActive ) {
                $this->activeTab = $component;
                $component->setActive( true );
            } else {
                $component->setActive( false );
            }

            if ( $storedActive === null && $component->isActive() ) {
                $storedActive                            = [ ];
                $storedActive [ $component->getTitle() ] = true;
                $this->menuPage->setPageOption( Options::PAGE_OPT_STATE, $storedActive );
            }
        }

        return parent::attachComponent( $component, $position );
    }

    public function getTabState( $tab ) {
        if ( ! ( $tab instanceof CmpTabForm || $tab instanceof CmpTab ) ) {
            return null;
        }

        $states = $this->menuPage->getPageOption( Options::PAGE_OPT_STATE );

        return ( $states && array_key_exists( $tab->getTitle(), $states ) ) ? $states[ $tab->getTitle() ] : null;
    }
}