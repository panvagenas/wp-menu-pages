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

    protected $panels = [];

    public function __construct(MenuPage $menuPage) {
        parent::__construct($menuPage);
    }

    public function addPanel(Panel $panel){
        if(!$this->hasPanel($panel)){
            $this->panels[$panel->getHashId()] = $panel;
        }

        return $this;
    }

    public function hasPanel(Panel $panel){
        return array_key_exists($panel->getHashId(), $this->panels);
    }

    public function getPanels(){
        return $this->panels;
    }
}