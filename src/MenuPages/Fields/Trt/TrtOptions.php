<?php
/**
 * TrtOptions.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     1.0.0
 * @package   Pan\MenuPages\Fields\Traits
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */


namespace Pan\MenuPages\Fields\Trt;

/**
 * Class TrtOptions
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      ${YEAR}-${MONTH}-${DAY}
 * @since     1.0.0
 * @package   Pan\MenuPages\Fields\Trt
 * @copyright Copyright (c) ${YEAR} Panagiotis Vagenas
 */
trait TrtOptions {
    /**
     * @var array
     */
    protected $options = [ ];

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    HasOptions::$options
     * @codeCoverageIgnore
     */
    public function getOptions() {
        return $this->options;
    }

    /**
     * @param array $options
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @codeCoverageIgnore
     */
    public function setOptions( $options ) {
        if ( $this->isValidOptionSchema( $options ) ) {
            $this->options = $options;
        }

        return $this;
    }

    /**
     * @param array $options
     *
     * @return bool
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    abstract function isValidOptionSchema( $options );
}