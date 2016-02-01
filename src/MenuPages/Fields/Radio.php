<?php
/**
 * Radio.php description
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
 * Class Radio
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class Radio extends AbsInput {
    use TrtOptions;

    const BUTTON_CLASS_DEFAULT = 'default';

    const BUTTON_CLASS_PRIMARY = 'primary';

    const BUTTON_CLASS_SUCCESS = 'success';

    const BUTTON_CLASS_INFO = 'info';

    const BUTTON_CLASS_WARNING = 'warning';

    const BUTTON_CLASS_DANGER = 'danger';

    protected $type = 'radio';

    protected $buttonClass = self::BUTTON_CLASS_PRIMARY;

    function isValidOptionSchema( $options ) {
        foreach ( $options as $name => $value ) {
            if ( ( ! is_string( $value ) && ! is_int( $value ) ) || ! is_string( $name ) ) {
                return false;
            }
        }

        return true;
    }

    public function isOptionChecked( $option ) {
        $checked = $this->getValue();

        if ( is_array( $checked ) && in_array( $option, $checked ) ) {
            return true;
        }

        return $checked == $option;
    }


    public function getTemplateName() {
        return 'fields/radio.twig';
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    Radio::$buttonClass
     * @codeCoverageIgnore
     */
    public function getButtonClass() {
        return $this->buttonClass;
    }

    /**
     * @param string $buttonClass
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @codeCoverageIgnore
     */
    public function setButtonClass( $buttonClass ) {
        $this->buttonClass = $buttonClass;

        return $this;
    }
}