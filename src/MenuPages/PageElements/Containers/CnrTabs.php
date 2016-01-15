<?php

namespace Pan\MenuPages\PageElements\Containers;

use Pan\MenuPages\Options;
use Pan\MenuPages\PageElements\Components\CmpTab;
use Pan\MenuPages\PageElements\Components\CmpTabForm;
use Pan\MenuPages\PageElements\Containers\Abs\AbsComponentsContainer;

class CnrTabs extends AbsComponentsContainer {
    const EL_TAB = 'tabs';
    protected $templateName = 'tabs.twig';
    protected $components = [
        self::EL_HEAD => [ ],
        self::EL_BODY => [ ],
        self::EL_FOOTER => [ ],
        self::EL_TAB => [],
    ];

    public function addTab($title,  $icon = ''){
        $tab = new CmpTabForm($this, $title, $icon);

        return $tab;
    }

    protected function isProperPosition( $position ) {
        return parent::isProperPosition( $position ) || $position === self::EL_TAB;
    }

    public function getMarkUp( $echo = false ) {
        if($this->components[self::EL_TAB]) {
            $states    = $this->menuPage->getPageOption( Options::PAGE_OPT_STATE, [ ] );
            $activeTab = '';
            /** @var CmpTab $tab */
            foreach ( $this->components[ self::EL_TAB ] as $tab ) {
                if ( array_key_exists( $tab->getTitle(), $states ) && $states[ $tab->getTitle() ] ) {
                    $activeTab = $tab->getTitle();
                }
            }
            if ( ! $activeTab ) {
                /** @var CmpTab $firstTab */
                $firstTab = array_values($this->components[self::EL_TAB])[0];
                $activeTab = $firstTab->getTitle();
            }
            foreach ( $this->components[ self::EL_TAB ] as $tab ) {
                $tab->setActive( $activeTab === $tab->getTitle() );
            }
        }

        return parent::getMarkUp( $echo );
    }

    public function getTabState($tab){
        if(!( $tab instanceof CmpTabForm || $tab instanceof CmpTab)){
            return null;
        }

        $states = $this->menuPage->getPageOption(Options::PAGE_OPT_STATE);

        return ($states && array_key_exists($tab->getTitle(), $states)) ? $states[$tab->getTitle()] : null;
    }
}