<?php
/**
 * TrtGlobalAttributes.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields\Trt
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Fields\Trt;

/**
 * Trait TrtGlobalAttributes
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields\Trt
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
trait TrtGlobalAttributes {
    /**
     * @var string
     */
    protected $class;
    /**
     * @var string
     */
    protected $id;
    /**
     * @var string
     */
    protected $style;

    /**
     * @return mixed
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    TrtGlobalAttributes::$class
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getClass() {
        return $this->class;
    }

    /**
     * Setter for {@link TrtGlobalAttributes::$class}
     *
     * @param mixed $class
     *
     * @return TrtGlobalAttributes
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function setClass( $class ) {
        $this->class = $class;

        return $this;
    }

    /**
     * @return mixed
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    TrtGlobalAttributes::$id
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Setter for {@link TrtGlobalAttributes::$id}
     *
     * @param mixed $id
     *
     * @return TrtGlobalAttributes
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function setId( $id ) {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    TrtGlobalAttributes::$style
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getStyle() {
        return $this->style;
    }

    /**
     * Setter for {@link TrtGlobalAttributes::$style}
     *
     * @param mixed $style
     *
     * @return TrtGlobalAttributes
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function setStyle( $style ) {
        $this->style = $style;

        return $this;
    }
}