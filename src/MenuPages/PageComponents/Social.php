<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pan\MenuPages\PageComponents;

use Pan\MenuPages\MenuPage;

/**
 * Description of Social
 *
 * @author vagenas
 */
class Social extends Abs\AbsMenuPageComponent{
    const ICON_FACEBOOK = 'facebook';
    const ICON_TWITTER = 'twitter';
    const ICON_WORDPRESS = 'wordpress';
    const ICON_GITHUB = 'github';

    protected $icon;
    protected $name;
    protected $link;

    public function __construct( MenuPage $menuPage, $name, $icon, $link) {
        parent::__construct($menuPage);
        $this->name = $name;
        $this->icon = $icon;
        $this->link = $link;
    }
    function getIcon() {
        return $this->icon;
    }

    function getName() {
        return $this->name;
    }

    function getLink() {
        return $this->link;
    }
}
