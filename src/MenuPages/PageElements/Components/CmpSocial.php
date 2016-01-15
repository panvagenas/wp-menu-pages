<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pan\MenuPages\PageElements\Components;

use Pan\MenuPages\PageElements\Components\Abs\AbsCmp;
use Pan\MenuPages\PageElements\Containers\Abs\AbsCnrComponents;

/**
 * Description of CmpSocial
 *
 * @author vagenas
 */
class CmpSocial extends AbsCmp {
    const ICON_FACEBOOK = 'facebook';

    const ICON_TWITTER = 'twitter';

    const ICON_WORDPRESS = 'wordpress';

    const ICON_GITHUB = 'github';

    protected $icon;
    protected $title;
    protected $link;

    protected $templateName = 'social.twig';

    public function __construct(
        AbsCnrComponents $container,
        $containerPosition = AbsCnrComponents::EL_BODY,
        $link,
        $title = '',
        $icon = ''
    ) {
        parent::__construct( $container, $containerPosition );
        $this->title = $title;
        $this->icon  = $icon;
        $this->link  = $link;
    }

    function getIcon() {
        return $this->icon;
    }

    function getTitle() {
        return $this->title;
    }

    function getLink() {
        return $this->link;
    }
}
