<?php
/**
 * Select.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     1.0.0
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Fields;

use Pan\MenuPages\Fields\Abs\AbsInputBase;
use Pan\MenuPages\Fields\Trt\TrtOptions;
use Pan\MenuPages\Fields\Trt\TrtValidation;
use Pan\MenuPages\PageElements\Components\Abs\AbsCmpFields;

/**
 * Class Select
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     1.0.0
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class Select extends AbsInputBase {
    use TrtOptions, TrtValidation;
    /**
     * @var string|int|float
     */
    protected $value;
    /**
     *
     * @var string
     */
    protected $type = 'select';
    /**
     * @var bool
     */
    protected $required;
    /**
     * @var int
     */
    protected $size;
    protected $multiple;

    /**
     * @inheritDoc
     */
    public function __construct( AbsCmpFields $component, $name ) {
        parent::__construct( $component, $name );
        $this->value = $this->getValue();
    }

    /**
     * @inheritDoc
     */
    public function validate( $value ) {
        return $this->isValid( $value, $this->label ?: $this->name );
    }

    /**
     * @inheritDoc
     */
    public function getTemplateName() {
        return 'fields/select.twig';
    }

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

    public function getValue() {
        return $this->menuPageComponent->getOptions()->get( $this->name );
    }

    public function getDefaultValue() {
        return $this->menuPageComponent->getOptions()->def( $this->name );
    }

    /**
     * @return mixed
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @see    AbsSelect::$required
     * @codeCoverageIgnore
     */
    public function getRequired() {
        return $this->required;
    }

    /**
     * @param mixed $required
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function setRequired( $required ) {
        $this->required = $required;

        return $this;
    }

    /**
     * @return mixed
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @see    AbsSelect::$size
     * @codeCoverageIgnore
     */
    public function getSize() {
        return $this->size;
    }

    /**
     * @param mixed $size
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function setSize( $size ) {
        $this->size = $size;

        return $this;
    }

    /**
     * @return mixed
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @see    AbsSelect::$multiple
     * @codeCoverageIgnore
     */
    public function getMultiple() {
        return $this->multiple;
    }
}