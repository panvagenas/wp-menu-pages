<?php

namespace Pan\MenuPages\PageElements\Containers;

use Pan\MenuPages\PageElements\Components\Form;
use Pan\MenuPages\PageElements\Components\Tab;
use Pan\MenuPages\PageElements\Containers\Abs\AbsComponentsContainer;

class Tabs extends AbsComponentsContainer {
    protected $templateName = 'tabs.twig';

    public function addTab($title, $active = false, $icon = '', Form $form = null){
        $tab = new Tab($this, $title, $active, $icon, $form);
        $this->attachComponent($tab);

        return $tab;
    }
}