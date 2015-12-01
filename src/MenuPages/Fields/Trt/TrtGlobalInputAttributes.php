<?php
/**
 * TrtGlobalInputAttributes.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields\Trt
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Fields\Trt;

/**
 * Trait TrtGlobalInputAttributes
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields\Trt
 * @copyright Copyright (c) 2015 Panagiotis Vagenas.
 */
trait TrtGlobalInputAttributes {
    /**
     * @var string
     */
    protected $type;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var bool
     */
    protected $autofocus;
    /**
     * @var bool
     */
    protected $disabled;

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
}