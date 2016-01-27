<?php

namespace Pan\MenuPages\PageElements\Containers;

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

    public function addTab( $title, $icon = '' ) {
        $tab = new CmpTabForm( $this, $title, $icon );

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

        if ( $component instanceof CmpTabForm || $component instanceof CmpTab ) {
            if ( ! $this->activeTab ) {
                $component->setActive();
                $this->activeTab = $component;
            }

            $storedActive = $this->menuPage->getElementState( $component->getTitle() );

            if ( $storedActive ) {
                $this->activeTab->setInactive();
                $component->setActive();

                $this->activeTab = $component;
            } else {
                $component->setInactive();
            }
        }

        return parent::attachComponent( $component, $position );
    }

    public function getTabState( $tab ) {
        if ( ! ( $tab instanceof CmpTabForm || $tab instanceof CmpTab ) ) {
            return null;
        }

        return $this->menuPage->getElementState( $tab->getTitle() );
    }
}