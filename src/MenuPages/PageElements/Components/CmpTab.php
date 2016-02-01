<?php
/**
 * CmpTab.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     1.0.0
 * @package   Pan\MenuPages\PageComponents
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\PageElements\Components;

use Pan\MenuPages\PageElements\Components\Abs\AbsCmp;
use Pan\MenuPages\PageElements\Components\Trt\TrtTab;
use Pan\MenuPages\PageElements\Containers\CnrTabs;
use Pan\MenuPages\Trt\TrtState;

/**
 * Class CmpTab
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     1.0.0
 * @package   Pan\MenuPages\PageComponents
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 *
 * @property CnrTabs $container
 */
class CmpTab extends AbsCmp {
    use TrtState, TrtTab;

    protected $templateName = 'tab.twig';

    protected $content = '';

    public function __construct(
        CnrTabs $container,
        $title,
        $icon = ''
    ) {
        $this->container = $container;
        $this->title     = $title;
        $this->icon      = $icon;
        parent::__construct( $container, CnrTabs::CNR_TAB );
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    Tab::$content
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * Setter for {@link CmpTab::$content}
     *
     * @param string $content
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function setContent( $content ) {
        $this->content = $content;

        return $this;
    }

    public function saveState() {
        $this->container->getMenuPage()->setElementState( $this->title, $this->active );
    }
}