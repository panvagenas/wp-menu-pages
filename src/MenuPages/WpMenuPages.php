<?php

namespace Pan\MenuPages;

use Pan\MenuPages\Pages\Abs\AbsMenuPage;

/**
 * Class WpMenuPages
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      ${YEAR}-${MONTH}-${DAY}
 * @since     1.0.0
 * @package   Pan\MenuPages
 * @copyright Copyright (c) ${YEAR} Panagiotis Vagenas
 */
final class WpMenuPages {
    /**
     * Holds instances of all registered pages
     *
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
     * The absolute path to this lib
     * @var string
     */
    protected $basePath;
    /**
     * Absolute path to plugin
     * @var string
     */
    protected $pluginBasePath;
    /**
     * Absolute path to plugin base file
     * @var string
     */
    protected $pluginBaseFile;
    /**
     * Rel path from plugin base folder to lib base folder
     * @var string
     */
    protected $basePathRelToPlugin;
    /**
     * Plugin options
     * @var Options
     */
    protected $options;

    /**
     * WpMenuPages constructor.
     *
     * @param string        $pluginBaseFile Absolute path to plugin main file
     * @param array|Options $options An instance of {@link Options} or an array with default options
     * @param string        $optionsBaseName In case the $options param is an array this should be a string
     *                                       defining the name of the options array as stored in DB
     *
     * @throws \InvalidArgumentException If $pluginBaseFile is empty or pointing to non readable file
     * @throws \InvalidArgumentException If $options isn't an instance of {@link Options} and is not an array
     *                                   and $optionsBaseName is empty
     * @throws \Exception If symlinks are used and couldn't resolve $pluginBaseFile path
     * @since  1.0.0
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     */
    public function __construct( $pluginBaseFile, $options, $optionsBaseName = '' ) {
        if ( empty( $pluginBaseFile ) || ! file_exists( $pluginBaseFile ) || ! is_readable( $pluginBaseFile ) ) {
            throw new \InvalidArgumentException( 'Invalid argument $pluginBaseFile in ' . __METHOD__ );
        }

        $pluginBaseFile = wp_normalize_path( $pluginBaseFile );

        $pluginIsSymlink = strpos( $pluginBaseFile, ABSPATH ) !== 0;
        $pagesIsSymlink  = strpos( __FILE__, ABSPATH ) !== 0;

        if ( $pluginIsSymlink ) {
            $pluginFolderName     = dirname( plugin_basename( $pluginBaseFile ) );
            $this->pluginBasePath = trailingslashit( WP_PLUGIN_DIR ) . $pluginFolderName;
            $this->pluginBaseFile = trailingslashit( $this->pluginBasePath ) . basename( $pluginBaseFile );
        } else {
            $this->pluginBasePath = dirname( $pluginBaseFile );
            $this->pluginBaseFile = realpath( $pluginBaseFile );
        }

        if ( $pagesIsSymlink ) {
            $this->basePath            = dirname( dirname( dirname( __FILE__ ) ) );
            $this->basePathRelToPlugin = str_replace( $this->pluginBasePath, '', $this->basePath );

            $dirItr = new \RecursiveDirectoryIterator( $this->pluginBasePath,
                \RecursiveDirectoryIterator::FOLLOW_SYMLINKS | \RecursiveDirectoryIterator::SKIP_DOTS );
            $itr    = new \RecursiveIteratorIterator( $dirItr );
            $res    = new \RegexIterator( $itr, '/WpMenuPages\.php/', \RecursiveIteratorIterator::LEAVES_ONLY );

            $res->next();

            /** @var \SplFileInfo $wpMenuPagesFile */
            $wpMenuPagesFile = $res->current();

            if ( ! ( $wpMenuPagesFile instanceof \SplFileInfo ) ) {
                // TODO Message
                throw new \Exception( 'Something went awfully wrong!' );
            }

            $this->basePath = dirname( dirname( $wpMenuPagesFile->getPath() ) );
        } else {
            $this->basePath = dirname( dirname( dirname( __FILE__ ) ) );
        }

        $this->basePathRelToPlugin = str_replace( $this->pluginBasePath, '', $this->basePath );

        if ( $options instanceof Options ) {
            $this->options = $options;
        } elseif ( is_array( $options ) && ! empty( $optionsBaseName ) ) {
            $this->options = Options::getInstance( $optionsBaseName, $options );
        } else {
            throw new \InvalidArgumentException( 'Invalid argument $options in ' . __METHOD__ );
        }
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    WpMenuPages::$basePath
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getBasePath() {
        return $this->basePath;
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    WpMenuPages::$menuPages
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getMenuPages() {
        return $this->menuPages;
    }

    /**
     * @return Options
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    WpMenuPages::$options
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getOptions() {
        return $this->options;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    WpMenuPages::$pluginBasePath
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getPluginBasePath() {
        return $this->pluginBasePath;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    WpMenuPages::$pluginBaseFile
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getPluginBaseFile() {
        return $this->pluginBaseFile;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    WpMenuPages::$basePathRelToPlugin
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getBasePathRelToPlugin() {
        return $this->basePathRelToPlugin;
    }

    /**
     * Registers a menu page
     *
     * @param AbsMenuPage $menuPage The menu page instance to be registered
     *
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    WpMenuPages::$menuPages
     * @since  1.0.0
     */
    public function attachMenuPage( AbsMenuPage $menuPage ) {
        $this->menuPages[ $menuPage->getMenuSlug() ] = $menuPage;
    }
}