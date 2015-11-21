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
    protected $type;
    protected $name;
    protected $value;
    protected $autocomplete;
    protected $maxlength;
    protected $placeholder;
    protected $size;
    protected $required;
    protected $autofocus;
    protected $disabled;

    /**
     * @return mixed
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    TrtInputAttributes::$autocomplete
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getAutocomplete() {
        return $this->autocomplete;
    }

    /**
     * Setter for {@link TrtInputAttributes::$autocomplete}
     *
     * @param mixed $autocomplete
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
     * @return mixed
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    TrtInputAttributes::$autofocus
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getAutofocus() {
        return $this->autofocus;
    }

    /**
     * Setter for {@link TrtInputAttributes::$autofocus}
     *
     * @param mixed $autofocus
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
     * @return mixed
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    TrtInputAttributes::$disabled
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getDisabled() {
        return $this->disabled;
    }

    /**
     * Setter for {@link TrtInputAttributes::$disabled}
     *
     * @param mixed $disabled
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
     * @return mixed
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
     * @param mixed $maxlength
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
     * @return mixed
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
     * @param mixed $name
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
     * @return mixed
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
     * @param mixed $placeholder
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
     * @return mixed
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    TrtInputAttributes::$required
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getRequired() {
        return $this->required;
    }

    /**
     * Setter for {@link TrtInputAttributes::$required}
     *
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

    /**
     * @return mixed
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
     * @param mixed $type
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
     * @return mixed
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
     * @param mixed $value
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