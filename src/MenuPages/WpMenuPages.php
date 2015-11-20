<?php

namespace Pan\MenuPages;

use Pan\MenuPages\Abs\AbsSingleton;

/**
 * Class WpMenuPages
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      ${YEAR}-${MONTH}-${DAY}
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages
 * @copyright Copyright (c) ${YEAR} Panagiotis Vagenas
 */
final class WpMenuPages extends AbsSingleton {
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
    /**
     * @var string
     */
    protected $basePath;

    /**
     * WpMenuPages constructor.
     *
     * @since  TODO ${VERSION}
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     */
    public function __construct() {
        $this->basePath = dirname( dirname( dirname( __FILE__ ) ) );
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    WpMenuPages::$basePath
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getBasePath() {
        return $this->basePath;
    }

    /**
     * Setter for {@link WpMenuPages::$basePath}
     *
     * @param string $basePath
     *
     * @return WpMenuPages
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function setBasePath( $basePath ) {
        $this->basePath = $basePath;

        return $this;
    }
}