<?php
/**
 * SwitchField.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Fields;

use Pan\MenuPages\PageComponents\Abs\AbsMenuPageFieldsComponent;

/**
 * Class SwitchField
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class SwitchField extends Radio {
    protected $type = 'radio';

    /**
     * SwitchField constructor.
     *
     * @param AbsMenuPageFieldsComponent $component
     * @param                            $name
     *
     * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
     */
    public function __construct( AbsMenuPageFieldsComponent $component, $name ) {
        parent::__construct( $component, $name );

        $this->setOptions(['No' => 0, 'Yes' => 1]);
    }
}