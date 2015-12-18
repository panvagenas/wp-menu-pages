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
use Pan\MenuPages\PageElements\Components\Abs\AbsFieldsComponent;
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

    protected $templateName = '';
    /**
     * @var Tabs
     */
    protected $container;
    /**
     * @var AbsFieldsComponent
     */
    protected $fieldsComponent;
    protected $markUp = '';

    public function __construct( Tabs $container, $title, $active = false, $icon = '', AbsFieldsComponent $fieldsComponent = null ) {
        parent::__construct( $container );
        $this->title  = $title;
        $this->active = $active;
        $this->icon   = $icon;

        if($fieldsComponent){
            $this->setFieldsComponent($fieldsComponent);
        }
    }

    public function getMarkUp( $echo = false ) {
        if($this->fieldsComponent){
            return $this->fieldsComponent->getMarkUp($echo);
        }

        return $this->markUp;
    }

    public function setMarkUp( $markUp ) {
        $this->markUp = $markUp;
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
     * @return mixed
     * @author Panagiotis Vagenas <Panagiotis.Vagenas@interactivedata.com>
     * @see    Tab::$form
     * @codeCoverageIgnore
     */
    public function getFieldsComponent() {
        return $this->fieldsComponent;
    }

    /**
     * @param AbsFieldsComponent $fieldsComponent
     *
     * @return $this
     * @author Panagiotis Vagenas <Panagiotis.Vagenas@interactivedata.com>
     * @codeCoverageIgnore
     */
    public function setFieldsComponent( AbsFieldsComponent $fieldsComponent ) {
        $this->fieldsComponent = $fieldsComponent;

        return $this;
    }
}