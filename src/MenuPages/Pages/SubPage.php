<?php
/**
 * AbsMenuPage.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-18
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Pages;

use Pan\MenuPages\PageComponents;
use Pan\MenuPages\WpMenuPages;

/**
 * Class AbsMenuPage
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-18
 * @package   Pan\MenuPages
 * @since     TODO ${VERSION}
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class SubPage extends Page {
    /**
     * @var Page
     */
    protected $parent;

    public function __construct(
        WpMenuPages $menuPages,
        Page $parent,
        $menuTitle,
        $menuSlug = '',
        $title = '',
        $capability = 'manage_options',
        $subtitle = '',
        $iconUrl = '',
        $position = null
    ) {
        parent::__construct( $menuPages, $menuTitle, $menuSlug, $title, $capability, $subtitle, $iconUrl, $position );
        $this->parent = $parent;
    }


    public function init() {
        $this->hookSuffix = add_submenu_page(
            $this->parent->getMenuSlug(),
            $this->title,
            $this->menuTitle,
            $this->capability,
            $this->menuSlug,
            [ $this, 'display' ]
        );
    }
}