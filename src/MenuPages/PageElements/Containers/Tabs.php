<?php

namespace Pan\MenuPages\PageElements\Containers;

use Pan\MenuPages\PageElements\Components\Form;
use Pan\MenuPages\PageElements\Containers\Abs\AbsComponentsContainer;

class Tabs extends AbsComponentsContainer {
    protected $templateName = 'tabs.twig';

    public function attachComponent(Tab $tab){
        parent::attachComponent($tab);
    }

    public function addTab($title, $active = false, $icon = '', Form $form = null){
        $this->attachComponent(new Tab($this, $title, $active, $icon, $form));

        return $this;
    }
}