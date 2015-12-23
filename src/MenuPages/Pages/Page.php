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

use Pan\MenuPages\Pages\Abs\AbsMenuPage;

/**
 * Class AbsMenuPage
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-18
 * @package   Pan\MenuPages
 * @since     TODO ${VERSION}
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class Page extends AbsMenuPage {
    const OPT_ACTIVE_TAB = 'activeTab';

    protected $validCoreOptionKeys = [
        self::OPT_ACTIVE_TAB,
    ];

    public function init() {
        $this->hookSuffix = add_menu_page(
            $this->title,
            $this->menuTitle,
            $this->capability,
            $this->menuSlug,
            [ $this, 'display' ],
            $this->iconUrl,
            $this->position
        );
    }

    public function getMarkUp() {
        return $this->getTwig()->getTwigEnvironment()->render( $this->templateName, ['el' => $this] );
    }
}