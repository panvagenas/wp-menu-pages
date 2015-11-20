<?php
/**
 * TrtOptions.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields\Traits
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */


namespace Pan\MenuPages\Fields\Trt;

trait TrtOptions {
    protected $options = [];

    /**
     * @return array
     * @author Panagiotis Vagenas <Panagiotis.Vagenas@interactivedata.com>
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
     * @author Panagiotis Vagenas <Panagiotis.Vagenas@interactivedata.com>
     * @codeCoverageIgnore
     */
    public function setOptions( $options ) {
        foreach ( $options as $index => $option ) {
            if(!$this->isValidOptionSchema($option)){
                unset($options[$index]);
            }
        }

        $this->options = $options;

        return $this;
    }

    abstract function isValidOptionSchema($options);
}