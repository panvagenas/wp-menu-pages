<?php

namespace Pan\MenuPages\Abs;

class AbsSingleton {
    /**
     * gets the instance via lazy initialization (created on first usage)
     *
     * @return self
     */
    public static function getInstance() {
        static $instance = null;
        if ( null === $instance ) {
            $instance = new static();
        }

        return $instance;
    }

    /**
     * is not allowed to call from outside: private!
     *
     */
    protected function __construct() {
    }

    /**
     * prevent the instance from being cloned
     *
     * @return void
     */
    protected function __clone() {
    }

    /**
     * prevent from being unserialized
     *
     * @return void
     */
    protected function __wakeup() {
    }
}