<?php

namespace Pan\MenuPages;

/**
 * Class WpMenuPages
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      ${YEAR}-${MONTH}-${DAY}
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages
 * @copyright Copyright (c) ${YEAR} Panagiotis Vagenas
 */
final class WpMenuPages {
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
     * @var string
     */
    protected $optionsBaseName;
    /**
     * @var string
     */
    protected $pluginBasePath;
    /**
     * @var Options
     */
    protected $options;

    /**
     * WpMenuPages constructor.
     *
     * @param string $optionsBaseName
     * @param string $pluginBasePath
     * @param array  $defaultOptions
     *
     * @throws \ErrorException
     * @since  TODO ${VERSION}
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     */
    public function __construct( $optionsBaseName, $pluginBasePath, array $defaultOptions ) {
        $this->basePath        = dirname( dirname( dirname( __FILE__ ) ) );
        $this->optionsBaseName = $optionsBaseName;
        $this->pluginBasePath  = $pluginBasePath;
        $this->options         = Options::getInstance( $this->optionsBaseName, $defaultOptions );
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
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    WpMenuPages::$menuPages
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getMenuPages() {
        return $this->menuPages;
    }

    /**
     * @return Options
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    WpMenuPages::$options
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getOptions() {
        return $this->options;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    WpMenuPages::$optionsBaseName
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getOptionsBaseName() {
        return $this->optionsBaseName;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    WpMenuPages::$pluginBasePath
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getPluginBasePath() {
        return $this->pluginBasePath;
    }
}