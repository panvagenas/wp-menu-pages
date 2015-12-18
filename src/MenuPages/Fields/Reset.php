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

use Pan\MenuPages\PageElements\Containers\Collapsible;

/**
 * Class Reset
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class Reset extends Button {
    protected $type = 'reset';

    public function __construct( Collapsible $panel, $name, $label ) {
        parent::__construct( $panel, $name, $label );
        $this->setClass( $this->class . ' btn-warning' );
    }
}