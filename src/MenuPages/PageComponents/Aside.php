<?php
/**
 * Aside.php description
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
 * Class Aside
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\PageComponents
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class Aside extends AbsMenuPageComponent{

    protected $sections = [];

    public function __construct(MenuPage $menuPage) {
        parent::__construct($menuPage);
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
}