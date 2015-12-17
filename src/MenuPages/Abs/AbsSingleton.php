<?php

namespace Pan\MenuPages\Abs;

use Pan\MenuPages\Pages\Abs\AbsMenuPage;

class AbsSingleton {
    /**
     * @var \Pan\MenuPages\Pages\Abs\AbsMenuPage
     */
    protected $menuPage;
    /**
     * is not allowed to call from outside: private!
     *
     */
    protected function __construct(AbsMenuPage $menuPage) {
        $this->menuPage = $menuPage;
    }

    /**
     * gets the instance via lazy initialization (created on first usage)
     *
     * @return $this
     */
    public static function getInstance(AbsMenuPage $menuPage) {
        static $instance = null;
        if ( null === $instance ) {
            $instance = new static($menuPage);
        }

        return $instance;
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