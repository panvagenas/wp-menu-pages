<?php
/**
 * SwitchField.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     1.0.0
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Fields;

use Pan\MenuPages\PageElements\Components\Abs\AbsCmpFields;

/**
 * Class SwitchField
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     1.0.0
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class SwitchField extends Radio {
    protected $type = 'radio';

    /**
     * SwitchField constructor.
     *
     * @param AbsCmpFields               $component
     * @param                            $name
     *
     * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
     */
    public function __construct( AbsCmpFields $component, $name ) {
        parent::__construct( $component, $name );

        $this->setOptions( [ 'No' => 0, 'Yes' => 1 ] );
    }
}