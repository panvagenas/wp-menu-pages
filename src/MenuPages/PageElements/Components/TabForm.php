<?php
/**
 * TabForm.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\PageComponents
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\PageElements\Components;

use Pan\MenuPages\PageElements\Components\Abs\AbsFieldsComponent;
use Pan\MenuPages\PageElements\Containers\Tabs;

/**
 * Class TabForm
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\PageComponents
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class TabForm extends AbsFieldsComponent {
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

    protected $templateName = 'tabForm.twig';
    /**
     * @var Tabs
     */
    protected $container;

    public function __construct(
        Tabs $container,
        $title,
        $active = false,
        $icon = ''
    ) {
        parent::__construct( $container, Tabs::EL_TAB );
        $this->container = $container;
        $this->title  = $title;
        $this->active = $active;
        $this->icon   = $icon;
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