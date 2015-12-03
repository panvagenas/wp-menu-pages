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

use Pan\MenuPages\Fields\Abs\AbsField;
use Pan\MenuPages\Fields\Trt\TrtGlobalInputAttributes;
use Pan\MenuPages\Fields\Trt\TrtOptions;
use Pan\MenuPages\Fields\Trt\TrtTemplate;
use Pan\MenuPages\PageComponents\Panel;

/**
 * Class CheckBox
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class Select extends AbsField {
    use TrtTemplate, TrtGlobalInputAttributes, TrtOptions;
    /**
     * @var string
     */
    protected $label;
    protected $type = 'select';
    /**
     * @var bool
     */
    protected $required;
    /**
     * @var int
     */
    protected $size;


    /**
     * @inheritDoc
     */
    public function __construct( Panel $panel, $name ) {
        parent::__construct( $panel );
        $this->name  = $name;
        $this->value = $this->getValue();
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
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @see    AbsInput::$label
     * @codeCoverageIgnore
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function setLabel( $label ) {
        $this->label = $label;

        return $this;
    }

    /**
     * @return mixed
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
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
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function setRequired( $required ) {
        $this->required = $required;

        return $this;
    }

    /**
     * @return mixed
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
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
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function setSize( $size ) {
        $this->size = $size;

        return $this;
    }
}