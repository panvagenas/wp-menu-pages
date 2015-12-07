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
     * @var string
     */
    protected $pluginBaseFile;
    /**
     * @var string
     */
    protected $basePathRelToPlugin;
    /**
     * @var Options
     */
    protected $options;

    /**
     * WpMenuPages constructor.
     *
     * @param string        $pluginBasePath
     * @param array|Options $options
     * @param string        $optionsBaseName
     *
     * @throws \ErrorException
     * @since  TODO ${VERSION}
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     */
    public function __construct(  $pluginBasePath, $pluginBaseFile, $options, $optionsBaseName = '' ) {
        $this->basePath        = dirname( dirname( dirname( __FILE__ ) ) );
        $this->optionsBaseName = $optionsBaseName;

        if(empty($pluginBasePath)){
            throw new \InvalidArgumentException('Invalid argument $pluginBasePath in ' . __METHOD__);
        }
        if(empty($pluginBaseFile)){
            throw new \InvalidArgumentException('Invalid argument $pluginBaseFile in ' . __METHOD__);
        }

        $this->pluginBasePath = $pluginBasePath;
        $this->pluginBaseFile = $pluginBaseFile;

        /**
         * FIXME This won't work with symlinks
         */
//        $basePathRelToPlugin = str_replace($this->pluginBasePath, '', $this->basePath);

        $this->basePathRelToPlugin = '/wp-menu-pages';

        if ( $options instanceof Options ) {
            $this->options = $options;
        } elseif ( is_array( $options ) && !empty($optionsBaseName) ) {
            $this->options = Options::getInstance( $this->optionsBaseName, $options );
        } else {
            throw new \InvalidArgumentException('Invalid argument $options in ' . __METHOD__);
        }
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

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    WpMenuPages::$optionsBaseName
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getPluginBaseFile() {
        return $this->pluginBaseFile;
    }
    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    WpMenuPages::$optionsBaseName
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getBasePathRelToPlugin() {
        return $this->basePathRelToPlugin;
    }
}