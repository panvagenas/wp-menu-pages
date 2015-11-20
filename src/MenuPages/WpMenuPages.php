<?php

namespace Pan\MenuPages;

use Pan\MenuPages\Abs\AbsSingleton;

class WpMenuPages extends AbsSingleton {
    /**
     * ```php
     *  [
     *      $pluginBaseName => [
     *                              $menuPageId => Pan\MenuPages\MenuPage $menuPage
     *                         ]
     *  ]
     * ```
     *
     * @var array
     */
    protected $menuPages = [ ];
}