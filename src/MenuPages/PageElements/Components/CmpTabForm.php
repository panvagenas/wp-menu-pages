<?php
/**
 * CmpTabForm.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\PageComponents
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\PageElements\Components;

use Pan\MenuPages\PageElements\Components\Abs\AbsCmpFields;
use Pan\MenuPages\PageElements\Containers\CnrTabs;

/**
 * Class CmpTabForm
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\PageComponents
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class CmpTabForm extends AbsCmpFields {
    /**
     * @var bool
     */
    protected $active = true;
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
     * @var CnrTabs
     */
    protected $container;

    public function __construct(
        CnrTabs $container,
        $title,
        $active = true,
        $icon = ''
    ) {
        parent::__construct( $container, CnrTabs::CNR_TAB );
        $this->container = $container;
        $this->title     = $title;

        $tabState = $this->container->getTabState( $this );
        $state    = $tabState !== null && $tabState;

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
}