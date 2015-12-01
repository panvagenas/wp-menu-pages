<?php
/**
 * Reset.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Fields;

use Pan\MenuPages\PageComponents\Section;

/**
 * Class Reset
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class Reset extends Button{
    protected $type = 'reset';
    public function __construct( Section $section, $name, $label ) {
        parent::__construct( $section, $name, $label );
        $this->setClass($this->class . ' btn-warning');
    }
}