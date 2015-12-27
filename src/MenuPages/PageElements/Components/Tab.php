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

namespace Pan\MenuPages\PageElements\Components;

use Pan\MenuPages\PageElements\Components\Abs\AbsComponent;
use Pan\MenuPages\PageElements\Containers\Tabs;

/**
 * Class Tab
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\PageComponents
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class Tab extends AbsComponent {
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

    protected $templateName = 'tab.twig';
    /**
     * @var Tabs
     */
    protected $container;

    protected $content = '';

    public function __construct(
        Tabs $container,
        $title,
        $icon = ''
    ) {
        parent::__construct( $container, Tabs::EL_TAB );
        $this->container = $container;
        $this->title  = $title;

        $tabState = $this->container->getTabState($this);
        $state = $tabState !== null && $tabState;

        $this->active = $state;
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

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    Tab::$content
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * Setter for {@link Tab::$content}
     *
     * @param string $content
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function setContent( $content ) {
        $this->content = $content;

        return $this;
    }
}