<?php
/**
 * Tab.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\PageComponents
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\PageComponents;

use Pan\MenuPages\PageComponents\Abs\AbsMenuPageFieldsComponent;
use Pan\MenuPages\Pages\Abs\AbsMenuPage;

/**
 * Class Tab
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\PageComponents
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class Tab extends AbsMenuPageFieldsComponent {
    /**
     * @var bool
     */
    protected $active = false;
    /**
     * @var string
     */
    protected $icon = '';
    /**
     * @var string
     */
    protected $title;

    public function __construct( AbsMenuPage $menuPage, $title, $active = false, $icon = '' ) {
        // FIXME Until we find a better way to activate tabs from AbsMenuPage we stick to set attrs before calling parent constructor
        $this->title  = $title;
        $this->active = $active;
        $this->icon   = $icon;

        parent::__construct( $menuPage );
    }

    public function isActive() {
        return $this->active;
    }

    public function setActive( $active ) {
        $this->active = $active;

        return $this;
    }

    public function getIcon() {
        return $this->icon;
    }

    public function setIcon( $icon ) {
        $this->icon = $icon;

        return $this;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle( $title ) {
        $this->title = $title;

        return $this;
    }
}