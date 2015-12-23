<?php

namespace Pan\MenuPages\PageElements\Containers;

use Pan\MenuPages\Options;
use Pan\MenuPages\PageElements\Components\Tab;
use Pan\MenuPages\PageElements\Components\TabForm;
use Pan\MenuPages\PageElements\Containers\Abs\AbsComponentsContainer;

class Tabs extends AbsComponentsContainer {
    const EL_TAB = 'tabs';
    protected $templateName = 'tabs.twig';
    protected $components = [
        self::EL_HEAD => [ ],
        self::EL_BODY => [ ],
        self::EL_FOOTER => [ ],
        self::EL_TAB => [],
    ];

    public function addTab($title, $active = false, $icon = ''){
        $tab = new TabForm($this, $title, $active, $icon);

        return $tab;
    }

    protected function isProperPosition( $position ) {
        return parent::isProperPosition( $position ) || $position === self::EL_TAB;
    }

    public function getTabState($tab){
        if(!($tab instanceof TabForm || $tab instanceof Tab)){
            return null;
        }

        $states = $this->menuPage->getPageOption(Options::PAGE_OPT_STATE);

        return ($states && array_key_exists($tab->getTitle(), $states)) ? $states[$tab->getTitle()] : null;
    }
}