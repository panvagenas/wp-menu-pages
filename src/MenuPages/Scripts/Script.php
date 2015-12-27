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

use Pan\MenuPages\Abs\AbsMultiSingleton;
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
class Script extends AbsMultiSingleton {
    protected $registered = [ ];
    protected $enqueued = [ ];
    protected $requiredStyles = [ ];
    protected $pathToAssets;
    protected $pluginRelPathToAssets;
    protected $pluginBaseFile;

    protected function __construct( AbsMenuPage $menuPage ) {
        parent::__construct( $menuPage );
        $assetsFolder                = IfcScripts::ASSETS_FOLDER;
        $this->pathToAssets          = $this->menuPage->getWpMenuPages()->getBasePath() . "/$assetsFolder";
        $this->pluginRelPathToAssets = $this->menuPage->getWpMenuPages()->getBasePathRelToPlugin() . "/$assetsFolder";
        $this->pluginBaseFile        = $this->menuPage->getWpMenuPages()->getPluginBaseFile();
    }

    public function printScripts() {
        foreach ( $this->requiredStyles as $styleSlug ) {
            wp_enqueue_style( $styleSlug );
        }

        wp_enqueue_script( IfcScripts::CORE_JS_SLUG );

        $baseUri = '/' . str_replace(
                trailingslashit($_SERVER['DOCUMENT_ROOT']),
                ''
                , $this->menuPage->getWpMenuPages()->getBasePath()
            );
        $uriPathToAssets = $baseUri . '/' . IfcScripts::ASSETS_FOLDER;
        $uriPathToJs = $uriPathToAssets . '/js';
        $uriPathToCss = $uriPathToAssets . '/css';

        $options = $this->menuPage->getOptions();

        wp_localize_script(IfcScripts::CORE_JS_SLUG, IfcScripts::CORE_JS_OBJECT, [
            'options' => [
                    'defaults' => $options->getDefaults(),
                    'options' => $options->getOptions(),
                    'baseName' => $options->getOptionsBaseName()
                ],
            'pages' => array_keys($this->menuPage->getWpMenuPages()->getMenuPages()),
            'wpUrl' => site_url(),
            'wpDateFormat' => get_option('date_format'),
            'wpTimeFormat' => get_option('time_format'),
            'baseUri'=> $baseUri,
            'uriPathToAssets' => $uriPathToAssets,
            'uriPathToCss' => $uriPathToCss,
            'uriPathToJs' => $uriPathToJs,
            'context' => $this->menuPage->getMenuSlug(),
            'nonce'   => [
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
        ]);
    }

    public function init() {
        wp_register_style(
            IfcScripts::CORE_CSS_SLUG,
            plugins_url( $this->pluginRelPathToAssets . '/css/wp-menu-pages.min.css', $this->pluginBaseFile ),
            [ ],
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

        if(IfcConstants::DEV){
            $requireJsUrl = plugins_url( $this->pluginRelPathToAssets . '/js/src/require.js', $this->pluginBaseFile );
            $appJs = plugins_url( $this->pluginRelPathToAssets . '/js/src/app.js', $this->pluginBaseFile );
        } else {
            $requireJsUrl = plugins_url( $this->pluginRelPathToAssets . '/js/dist/require.js', $this->pluginBaseFile );
            $appJs = plugins_url( $this->pluginRelPathToAssets . '/js/dist/app.js', $this->pluginBaseFile );
        }

        wp_register_script(
            IfcScripts::REQUIRE_JS_SLUG,
            $requireJsUrl,
            [ ],
            IfcConstants::VERSION
        );

        wp_register_script(
            IfcScripts::CORE_JS_SLUG,
            $appJs,
            [ IfcScripts::REQUIRE_JS_SLUG ],
            IfcConstants::VERSION
        );
    }

    public function requireFontAwesome() {
        $this->requiredStyles[ IfcScripts::SLUG_FONT_AWESOME_CSS ] = IfcScripts::SLUG_FONT_AWESOME_CSS;

        return $this;
    }

    public function requireSelect2() {
        $this->requiredStyles[ IfcScripts::SLUG_SELECT2_CSS ] = IfcScripts::SLUG_SELECT2_CSS;

        return $this;
    }

    public function requireWpMenuPagesScripts() {
        $this->requiredStyles[ IfcScripts::CORE_CSS_SLUG ] = IfcScripts::CORE_CSS_SLUG;

        return $this;
    }
}