<?php
/**
 * Options.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages;

/**
 * Class Options
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class Options {
    /**
     * @var string
     */
    protected $optionsBaseName;
    /**
     * @var array
     */
    protected $defaults;
    /**
     * @var array
     */
    protected $options;

    /**
     * Options constructor.
     *
     * @param string $optionsBaseName
     * @param array  $defaults
     *
     * @since  TODO ${VERSION}
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     */
    protected function __construct( $optionsBaseName, array $defaults ) {
        $this->optionsBaseName = $optionsBaseName;
        $this->defaults        = $defaults;
        $this->options         = get_option( $this->optionsBaseName, $this->defaults );
    }

    /**
     * @param       $optionsBaseName
     * @param array $defaults
     *
     * @return mixed
     * @throws \ErrorException
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public static function getInstance( $optionsBaseName, array $defaults = [ ] ) {
        static $instance = [ ];
        if ( ! isset( $instance[ $optionsBaseName ] ) ) {
            if ( empty( $defaults ) ) {
                throw new \ErrorException( 'You always must pass the default option values when instantiating '
                                           . __CLASS__ );
            }
            $instance[ $optionsBaseName ] = new static( $optionsBaseName, $defaults );
        }

        return $instance[ $optionsBaseName ];
    }

    /**
     * @param $name
     *
     * @return mixed
     * @throws \ErrorException
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function get( $name ) {
        if ( $this->exists( $name ) ) {
            return $this->options[ $name ];
        }
        throw new \ErrorException( 'Invalid option in ' . __METHOD__ );
    }

    /**
     * @param $name
     *
     * @return bool
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function exists( $name ) {
        return isset( $this->options[ $name ] );
    }

    /**
     * @param $name
     * @param $value
     *
     * @return bool
     * @throws \ErrorException
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function set( $name, $value ) {
        if ( $this->exists( $name ) ) {
            $this->options[ $name ] = $value;

            return $this->save();
        }
        throw new \ErrorException( 'Invalid option in ' . __METHOD__ );
    }

    /**
     * @return bool
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    protected function save() {
        return update_option( $this->optionsBaseName, $this->options );
    }

    /**
     * @param $name
     *
     * @return mixed
     * @throws \ErrorException
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function def( $name ) {
        if ( $this->exists( $name ) ) {
            return $this->defaults[ $name ];
        }
        throw new \ErrorException( 'Invalid option in ' . __METHOD__ );
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    Options::$defaults
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getDefaults() {
        return $this->defaults;
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    Options::$options
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getOptions() {
        return $this->options;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    Options::$optionsBaseName
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getOptionsBaseName() {
        return $this->optionsBaseName;
    }

    /**
     * prevent the instance from being cloned
     *
     * @return void
     */
    protected function __clone() {
    }

    /**
     * prevent from being un-serialized
     *
     * @return void
     */
    protected function __wakeup() {
    }
}