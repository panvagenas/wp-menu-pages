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

use Pan\MenuPages\PageComponents\Abs\AbsMenuPageComponent;
use Pan\MenuPages\MenuPage;

/**
 * Class Tab
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\PageComponents
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class Tab extends AbsMenuPageComponent{

    protected $active = false;
    protected $icon = '';
    protected $title;
    protected $sections = [];

    public function __construct(MenuPage $menuPage, $title, $active = false, $icon = '') {
        parent::__construct($menuPage);
        $this->title  = $title;
        $this->active = $active;
        $this->icon   = $icon;
    }

    public function addSection(Section $section){
        if(!$this->hasSection($section)){
            $this->sections[$section->getHashId()] = $section;
        }

        return $this;
    }

    public function hasSection(Section $section){
        return array_key_exists($section->getHashId(), $this->sections);
    }

    public function getSections(){
        return $this->sections;
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