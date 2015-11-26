<?php
/**
 * TrtInputAttributes.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields\Trt
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Fields\Trt;

/**
 * Trait TrtInputAttributes
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields\Trt
 * @copyright Copyright (c) 2015 Panagiotis Vagenas.
 */
trait TrtInputAttributes {
    /**
     * @var string
     */
    protected $type;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string|int|float
     */
    protected $value;
    /**
     * @var bool
     */
    protected $autocomplete;
    /**
     * @var int
     */
    protected $maxlength;
    /**
     * @var string
     */
    protected $placeholder;
    /**
     * @var int
     */
    protected $size;
    /**
     * @var bool
     */
    protected $required;
    /**
     * @var bool
     */
    protected $autofocus;
    /**
     * @var bool
     */
    protected $disabled;
    /**
     * @var string
     */
    protected $label;

    /**
     * @return boolean
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    TrtInputAttributes::$autocomplete
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function isAutocomplete() {
        return $this->autocomplete;
    }

    /**
     * Setter for {@link TrtInputAttributes::$autocomplete}
     *
     * @param boolean $autocomplete
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function setAutocomplete( $autocomplete ) {
        $this->autocomplete = $autocomplete;

        return $this;
    }

    /**
     * @return boolean
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    TrtInputAttributes::$autofocus
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function isAutofocus() {
        return $this->autofocus;
    }

    /**
     * Setter for {@link TrtInputAttributes::$autofocus}
     *
     * @param boolean $autofocus
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function setAutofocus( $autofocus ) {
        $this->autofocus = $autofocus;

        return $this;
    }

    /**
     * @return boolean
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    TrtInputAttributes::$disabled
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function isDisabled() {
        return $this->disabled;
    }

    /**
     * Setter for {@link TrtInputAttributes::$disabled}
     *
     * @param boolean $disabled
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function setDisabled( $disabled ) {
        $this->disabled = $disabled;

        return $this;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    TrtInputAttributes::$label
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * Setter for {@link TrtInputAttributes::$label}
     *
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
     * @return int
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    TrtInputAttributes::$maxlength
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getMaxlength() {
        return $this->maxlength;
    }

    /**
     * Setter for {@link TrtInputAttributes::$maxlength}
     *
     * @param int $maxlength
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function setMaxlength( $maxlength ) {
        $this->maxlength = $maxlength;

        return $this;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    TrtInputAttributes::$name
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Setter for {@link TrtInputAttributes::$name}
     *
     * @param string $name
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function setName( $name ) {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    TrtInputAttributes::$placeholder
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getPlaceholder() {
        return $this->placeholder;
    }

    /**
     * Setter for {@link TrtInputAttributes::$placeholder}
     *
     * @param string $placeholder
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function setPlaceholder( $placeholder ) {
        $this->placeholder = $placeholder;

        return $this;
    }

    /**
     * @return boolean
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    TrtInputAttributes::$required
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function isRequired() {
        return $this->required;
    }

    /**
     * Setter for {@link TrtInputAttributes::$required}
     *
     * @param boolean $required
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
     * @return int
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    TrtInputAttributes::$size
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getSize() {
        return $this->size;
    }

    /**
     * Setter for {@link TrtInputAttributes::$size}
     *
     * @param int $size
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

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    TrtInputAttributes::$type
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Setter for {@link TrtInputAttributes::$type}
     *
     * @param string $type
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function setType( $type ) {
        $this->type = $type;

        return $this;
    }

    /**
     * @return float|int|string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    TrtInputAttributes::$value
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * Setter for {@link TrtInputAttributes::$value}
     *
     * @param float|int|string $value
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function setValue( $value ) {
        $this->value = $value;

        return $this;
    }
}