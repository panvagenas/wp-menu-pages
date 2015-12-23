<?php

namespace Pan\MenuPages\PageElements\Containers;

use Pan\MenuPages\PageElements\Components\Tab;
use Pan\MenuPages\PageElements\Components\TabForm;
use Pan\MenuPages\PageElements\Containers\Abs\AbsComponentsContainer;
use Pan\MenuPages\Pages\Page;

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
        $tab = new Tab($this, $title, $active, $icon);
        $state = $this->getTabState($tab) !== null ? $this->getTabState($tab) : $active;
        $tab->setActive($state);

        return $tab;
    }

    public function addTabForm($title, $active = false, $icon = ''){
        $tab = new TabForm($this, $title, $active, $icon);
        $state = $this->getTabState($tab) !== null ? $this->getTabState($tab) : $active;
        $tab->setActive($state);

        return $tab;
    }

    protected function isProperPosition( $position ) {
        return parent::isProperPosition( $position ) || $position === self::EL_TAB;
    }

    public function getTabState($tab){
        if(!($tab instanceof TabForm || $tab instanceof Tab)){
            return null;
        }

        $activeTab = $this->getMenuPage()->getPageOption(Page::OPT_ACTIVE_TAB);

        if(is_wp_error($activeTab)){
            return null;
        }

        return $activeTab === $tab->getTitle();
    }
}