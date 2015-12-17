<?php

namespace Pan\MenuPages;

use Pan\MenuPages\Pages\Abs\AbsMenuPage;

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
     *                              $menuPageId => Pan\MenuPages\Pages\Abs\AbsMenuPage $menuPage
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
     * @param string        $pluginBaseFile
     * @param array|Options $options
     * @param string        $optionsBaseName
     * @param string        $relBasePath
     *
     * @throws \ErrorException
     * @since  TODO ${VERSION}
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     */
    public function __construct(  $pluginBaseFile, $options, $optionsBaseName = '', $relBasePath = '' ) {
        if(empty($pluginBaseFile)){
            throw new \InvalidArgumentException('Invalid argument $pluginBaseFile in ' . __METHOD__);
        }

        $this->pluginBasePath = dirname($pluginBaseFile);
        $this->pluginBaseFile = realpath($pluginBaseFile);

        if($relBasePath){
            $this->basePath = $this->pluginBasePath . '/' . $relBasePath;
            $this->basePathRelToPlugin = $relBasePath;
        } else {
            $this->basePath = dirname( dirname( dirname( __FILE__ ) ) );
            $this->basePathRelToPlugin = str_replace($this->pluginBasePath, '', $this->basePath);
        }

        if ( $options instanceof Options ) {
            $this->options = $options;
        } elseif ( is_array( $options ) && !empty($optionsBaseName) ) {
            $this->options = Options::getInstance( $optionsBaseName, $options );
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
     * @see    WpMenuPages::$pluginBaseFile
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getPluginBaseFile() {
        return $this->pluginBaseFile;
    }
    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    WpMenuPages::$basePathRelToPlugin
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getBasePathRelToPlugin() {
        return $this->basePathRelToPlugin;
    }
    public function attachMenuPage(AbsMenuPage $menuPage){
        $this->menuPages[$menuPage->getMenuSlug()] = $menuPage;
    }
}