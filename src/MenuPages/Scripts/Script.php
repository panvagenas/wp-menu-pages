<?php
/**
 * Script.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-12-04
 * @package   Pan\MenuPages\Scripts
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */


namespace Pan\MenuPages\Scripts;

use Pan\MenuPages\Abs\AbsPageSingleton;
use Pan\MenuPages\Ifc\IfcConstants;
use Pan\MenuPages\Pages\Abs\AbsMenuPage;
use Pan\MenuPages\Scripts\Ifc\IfcScripts;

/**
 * Class Script
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-12-04
 * @package   Pan\MenuPages\Scripts
 * @since     TODO ${VERSION}
 */
class Script extends AbsPageSingleton {
    /**
     * @var array
     */
    protected $registered = [ ];
    /**
     * @var array
     */
    protected $enqueued = [ ];
    /**
     * @var array
     */
    protected $requiredStyles = [ ];
    /**
     * @var string
     */
    protected $pathToAssets;
    /**
     * @var string
     */
    protected $pluginRelPathToAssets;
    /**
     * @var string
     */
    protected $pluginBaseFile;

    /**
     * Script constructor.
     *
     * @param AbsMenuPage $menuPage
     *
     * @since  TODO ${VERSION}
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     */
    protected function __construct( AbsMenuPage $menuPage ) {
        parent::__construct( $menuPage );
        $assetsFolder                = IfcScripts::ASSETS_FOLDER;
        $this->pathToAssets          = $this->menuPage->getWpMenuPages()->getBasePath() . "/$assetsFolder";
        $this->pluginRelPathToAssets = $this->menuPage->getWpMenuPages()->getBasePathRelToPlugin() . "/$assetsFolder";
        $this->pluginBaseFile        = $this->menuPage->getWpMenuPages()->getPluginBaseFile();
    }

    /**
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function printScripts() {
        wp_enqueue_style( IfcScripts::CORE_CSS_SLUG );
        wp_enqueue_script( IfcScripts::CORE_JS_SLUG );

        /**
         * Filter wpMenuPages object passed to js files
         *
         * @param array $menuPagesJsLoc Containing all properties to be passed to the object
         */
        $menuPagesJsLoc = apply_filters(
            "Scripts/Script/printScripts@{$this->menuPage->getOptions()->getOptionsBaseName()}",
            $this->getArrayForJsObj()
        );

        wp_localize_script( IfcScripts::CORE_JS_SLUG, IfcScripts::CORE_JS_OBJECT, $menuPagesJsLoc );
    }

    protected function getArrayForJsObj() {
        $baseUri = '/' . str_replace(
                trailingslashit( $_SERVER['DOCUMENT_ROOT'] ),
                '',
                $this->menuPage->getWpMenuPages()->getBasePath()
            );

        $uriPathToAssets = $baseUri . '/' . IfcScripts::ASSETS_FOLDER;
        $uriPathToJs     = $uriPathToAssets . '/js/' . ( IfcConstants::DEV ? 'src' : 'dist' );
        $uriPathToCss    = $uriPathToAssets . '/css';

        $options = $this->menuPage->getOptions();

        return [
            'options'            => [
                'defaults' => $options->getDefaults(),
                'options'  => $options->getOptions(),
                'baseName' => $options->getOptionsBaseName(),
            ],
            'pages'              => array_keys( $this->menuPage->getWpMenuPages()->getMenuPages() ),
            'wpUrl'              => site_url(),
            'wpDateFormat'       => get_option( 'date_format' ),
            'wpTimeFormat'       => get_option( 'time_format' ),
            'wpMenuPagesBaseUri' => $baseUri,
            'uriPathToAssets'    => $uriPathToAssets,
            'uriPathToCss'       => $uriPathToCss,
            'uriPathToJs'        => $uriPathToJs,
            'context'            => $this->menuPage->getMenuSlug(),
            'nonce'              => [
                IfcScripts::ACTION_SAVE_PREFIX . $this->menuPage->getMenuSlug() =>
                    wp_create_nonce( IfcScripts::ACTION_SAVE_PREFIX . $this->menuPage->getMenuSlug() ),

                IfcScripts::ACTION_RESET_PREFIX . $this->menuPage->getMenuSlug() =>
                    wp_create_nonce( IfcScripts::ACTION_RESET_PREFIX . $this->menuPage->getMenuSlug() ),

                IfcScripts::ACTION_IMPORT_PREFIX . $this->menuPage->getMenuSlug() =>
                    wp_create_nonce( IfcScripts::ACTION_IMPORT_PREFIX . $this->menuPage->getMenuSlug() ),

                IfcScripts::ACTION_EXPORT_PREFIX . $this->menuPage->getMenuSlug() =>
                    wp_create_nonce( IfcScripts::ACTION_EXPORT_PREFIX . $this->menuPage->getMenuSlug() ),

                IfcScripts::ACTION_UPDATE_CORE_OPTIONS_PREFIX . $this->menuPage->getMenuSlug() =>
                    wp_create_nonce( IfcScripts::ACTION_UPDATE_CORE_OPTIONS_PREFIX . $this->menuPage->getMenuSlug() ),
            ],
            'actions'            => [
                'actionSavePrefix'              => IfcScripts::ACTION_SAVE_PREFIX,
                'actionResetPrefix'             => IfcScripts::ACTION_RESET_PREFIX,
                'actionExportPrefix'            => IfcScripts::ACTION_EXPORT_PREFIX,
                'actionImportPrefix'            => IfcScripts::ACTION_IMPORT_PREFIX,
                'actionUpdateCoreOptionsPrefix' => IfcScripts::ACTION_UPDATE_CORE_OPTIONS_PREFIX,
            ],
        ];
    }

    /**
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function init() {
        wp_register_style(
            IfcScripts::CORE_CSS_SLUG,
            plugins_url( $this->pluginRelPathToAssets . '/css/wp-menu-pages.min.css', $this->pluginBaseFile ),
            [ IfcScripts::SLUG_FONT_AWESOME_CSS, IfcScripts::SLUG_SELECT2_CSS ],
            IfcConstants::VERSION
        );

        wp_register_style(
            IfcScripts::SLUG_FONT_AWESOME_CSS,
            IfcScripts::CDN_FONT_AWESOME_CSS,
            [ ],
            IfcConstants::VERSION
        );

        wp_register_style(
            IfcScripts::SLUG_SELECT2_CSS,
            plugins_url( $this->pluginRelPathToAssets . '/css/select2.min.css', $this->pluginBaseFile ),
            [ ],
            IfcConstants::VERSION
        );

        wp_register_script(
            IfcScripts::CORE_JS_SLUG,
            IfcConstants::DEV
                ? plugins_url( $this->pluginRelPathToAssets . '/js/mnp-core.js', $this->pluginBaseFile )
                : plugins_url( $this->pluginRelPathToAssets . '/js/mnp-core.min.js', $this->pluginBaseFile ),
            [
                'jquery',
                IfcScripts::SLUG_BOOTSTRAP_JS,
                IfcScripts::SLUG_SELECT2_JS,
                IfcScripts::SLUG_DATETIME_PICKER_JS,
                IfcScripts::SLUG_FILE_SAVER_JS,
            ],
            IfcConstants::VERSION
        );

        wp_register_script(
            IfcScripts::SLUG_BOOTSTRAP_JS,
            IfcScripts::CDN_BOOTSTRAP_JS,
            [ 'jquery' ],
            IfcConstants::VERSION
        );
        wp_register_script(
            IfcScripts::SLUG_SELECT2_JS,
            IfcScripts::CDN_SELECT2_JS,
            [ 'jquery' ],
            IfcConstants::VERSION
        );
        wp_register_script(
            IfcScripts::SLUG_MOMENT_JS,
            IfcConstants::DEV
                ? plugins_url( $this->pluginRelPathToAssets . '/js/lib/moment.js', $this->pluginBaseFile )
                : plugins_url( $this->pluginRelPathToAssets . '/js/lib/moment.min.js', $this->pluginBaseFile ),
            [ 'jquery' ],
            IfcConstants::VERSION
        );
        wp_register_script(
            IfcScripts::SLUG_DATETIME_PICKER_JS,
            IfcConstants::DEV
                ? plugins_url( $this->pluginRelPathToAssets . '/js/lib/dateTimePicker.js', $this->pluginBaseFile )
                : plugins_url( $this->pluginRelPathToAssets . '/js/lib/dateTimePicker.min.js', $this->pluginBaseFile ),
            [ 'jquery', IfcScripts::SLUG_MOMENT_JS ],
            IfcConstants::VERSION
        );
        wp_register_script(
            IfcScripts::SLUG_FILE_SAVER_JS,
            IfcConstants::DEV
                ? plugins_url( $this->pluginRelPathToAssets . '/js/lib/fileSaver.js', $this->pluginBaseFile )
                : plugins_url( $this->pluginRelPathToAssets . '/js/lib/fileSaver.min.js', $this->pluginBaseFile ),
            [ 'jquery' ],
            IfcConstants::VERSION
        );
    }
}