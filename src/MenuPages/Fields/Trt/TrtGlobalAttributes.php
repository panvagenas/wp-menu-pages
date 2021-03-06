<?php
/**
 * TrtGlobalAttributes.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     1.0.0
 * @package   Pan\MenuPages\Fields\Trt
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Fields\Trt;

/**
 * Trait TrtGlobalAttributes
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     1.0.0
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
    protected $style;

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    TrtGlobalAttributes::$class
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getClass() {
        return $this->class;
    }

    /**
     * Setter for {@link TrtGlobalAttributes::$class}
     *
     * @param string $class
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function setClass( $class ) {
        $this->class = $class;

        return $this;
    }

    /**
     * @param $className
     *
     * @return $this
     *
     * @since  1.0.0
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     */
    public function addClass( $className ) {
        $this->setClass( $this->class . ' ' . $className );

        return $this;
    }

    /**
     * @param $className
     *
     * @return $this
     *
     * @since  1.0.0
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     */
    public function removeClass( $className ) {
        $names = explode( ' ', $this->class );
        $key   = array_search( $className, $names );
        if ( $key !== false ) {
            unset( $names[ $key ] );
            $this->setClass( implode( ' ', $names ) );
        }

        return $this;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    TrtGlobalAttributes::$style
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getStyle() {
        return $this->style;
    }

    /**
     * Setter for {@link TrtGlobalAttributes::$style}
     *
     * @param string $style
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function setStyle( $style ) {
        $this->style = $style;

        return $this;
    }
}