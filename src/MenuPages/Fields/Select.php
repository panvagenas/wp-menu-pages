<?php
/**
 * CheckBox.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Fields;

use Pan\MenuPages\Fields\Abs\AbsInput;
use Pan\MenuPages\Fields\Trt\TrtOptions;

/**
 * Class CheckBox
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class Select extends AbsInput {
    use TrtOptions;
    protected $type = 'select';

    function isValidOptionSchema( $options, $_recursive = false ) {
        foreach ( $options as $name => $value ) {
            if ( ! is_string( $name ) && ! is_int( $name ) ) {
                return false;
            }
            if ( ! is_string( $value ) && ! is_int( $value ) && ! is_array( $value ) ) {
                return false;
            }
            if ( is_array( $value ) && ( $_recursive || ! $this->isValidOptionSchema( $value, true ) ) ) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    protected function getAttributesArray() {
        $out = parent::getAttributesArray();

        $out['options'] = $this->options;

        return $out;
    }
    /**
     * @inheritDoc
     */
    public function getTemplateName() {
        return 'fields/select.twig';
    }

}