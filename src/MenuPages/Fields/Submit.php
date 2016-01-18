<?php
/**
 * Submit.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Fields;

use Pan\MenuPages\PageElements\Components\Abs\AbsCmpFields;

/**
 * Class Submit
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class Submit extends Button {
    protected $type = 'submit';

    public function __construct( AbsCmpFields $component, $name, $label ) {
        parent::__construct( $component, $label );
        $this->setClass( $this->class . ' btn-primary' );
    }
}