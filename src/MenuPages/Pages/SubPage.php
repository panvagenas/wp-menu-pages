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
    const PARENT_DASHBOARD = 'index.php';

    const PARENT_POSTS = 'edit.php';

    const PARENT_MEDIA = 'upload.php';

    const PARENT_LINKS = 'link-manager.php';

    const PARENT_PAGES = 'edit.php?post_type=page';

    const PARENT_COMMENTS = 'edit-comments.php';

    const PARENT_APPEARANCE = 'themes.php';

    const PARENT_PLUGINS = 'plugins.php';

    const PARENT_USERS = 'users.php';

    const PARENT_TOOLS = 'tools.php';

    const PARENT_SETTINGS = 'options-general.php';

    const PARENT_SETTINGS_NET = 'settings.php';

    /**
     * @var Page
     */
    protected $parent;

    public function __construct(
        WpMenuPages $menuPages,
        $parent,
        $menuTitle,
        $menuSlug = '',
        $title = '',
        $capability = 'manage_options',
        $subtitle = '',
        $iconUrl = '',
        $position = null
    ) {
        parent::__construct( $menuPages, $menuTitle, $menuSlug, $title, $capability, $subtitle, $iconUrl, $position );

        if ( ! ( is_string( $parent ) || $parent instanceof Page ) ) {
            throw new \InvalidArgumentException( 'Wrong parent page' );
        }

        $this->parent = $parent;
    }


    public function init() {
        $this->hookSuffix = add_submenu_page(
            is_string( $this->parent ) ? $this->parent : $this->parent->getMenuSlug(),
            $this->title,
            $this->menuTitle,
            $this->capability,
            $this->menuSlug,
            [ $this, 'display' ]
        );
    }
}