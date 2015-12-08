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

use Pan\MenuPages\Abs\AbsSingleton;
use Pan\MenuPages\Ifc\IfcConstants;
use Pan\MenuPages\MenuPage;
use Pan\MenuPages\Scripts\Ifc\IfcScripts;

/**
 * Class Script
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-12-04
 * @package   Pan\MenuPages\Scripts
 * @since     TODO ${VERSION}
 */
class Script extends AbsSingleton {
    protected $registered = [ ];
    protected $enqueued = [ ];
    protected $requiredScripts = [];
    protected $requiredStyles = [];
    protected $pathToAssets;
    protected $pluginRelPathToAssets;
    protected $pluginBaseFile;

    protected function __construct( MenuPage $menuPage ) {
        parent::__construct( $menuPage );
        $assetsFolder = IfcScripts::ASSETS_FOLDER;
        $this->pathToAssets = $this->menuPage->getWpMenuPages()->getBasePath() . "/$assetsFolder";
        $this->pluginRelPathToAssets = $this->menuPage->getWpMenuPages()->getBasePathRelToPlugin() . "/$assetsFolder";
        $this->pluginBaseFile = $this->menuPage->getWpMenuPages()->getPluginBaseFile();
    }

    public function printScripts(){
        foreach ( $this->requiredScripts as $scriptSlug ) {
            $this->enqueueScript($scriptSlug);
        }
        foreach ( $this->requiredStyles as $styleSlug ) {
            $this->enqueueStyle($styleSlug);
        }

        wp_localize_script(IfcScripts::CORE_JS_SLUG, IfcScripts::CORE_JS_DEFINITIONS,
            [
                'context' => $this->menuPage->getMenuSlug(),
                'nonce' => [
                    IfcScripts::ACTION_SAVE_PREFIX.$this->menuPage->getMenuSlug() => wp_create_nonce(IfcScripts::ACTION_SAVE_PREFIX.$this->menuPage->getMenuSlug()),
                    IfcScripts::ACTION_RESET_PREFIX.$this->menuPage->getMenuSlug() => wp_create_nonce(IfcScripts::ACTION_RESET_PREFIX.$this->menuPage->getMenuSlug()),
                    IfcScripts::ACTION_IMPORT_PREFIX.$this->menuPage->getMenuSlug() => wp_create_nonce(IfcScripts::ACTION_IMPORT_PREFIX.$this->menuPage->getMenuSlug()),
                    IfcScripts::ACTION_EXPORT_PREFIX.$this->menuPage->getMenuSlug() => wp_create_nonce(IfcScripts::ACTION_EXPORT_PREFIX.$this->menuPage->getMenuSlug()),
                ]
            ]
        );
    }
    public function init(){
        $this->registerStyle(
            IfcScripts::SLUG_BOOTSTRAP_CSS,
            plugins_url($this->pluginRelPathToAssets.'/bootstrap/dist/css/bootstrap.min.css', $this->pluginBaseFile),
            [],
            IfcConstants::VERSION
        );
        $this->registerStyle(
            IfcScripts::SLUG_BOOTSTRAP_THEME_CSS,
            plugins_url($this->pluginRelPathToAssets.'/bootstrap/dist/css/bootstrap-theme.min.css', $this->pluginBaseFile),
            [IfcScripts::SLUG_BOOTSTRAP_CSS],
            IfcConstants::VERSION
        );
        $this->registerScript(
            IfcScripts::SLUG_BOOTSTRAP_JS,
            IfcScripts::CDN_BOOTSTRAP_JS,
            ['jquery'],
            IfcConstants::VERSION,
            true
        );
        $this->registerStyle(
            IfcScripts::CORE_CSS_SLUG,
            plugins_url($this->pluginRelPathToAssets.'/css/wp-menu-pages.css', $this->pluginBaseFile),
            [IfcScripts::SLUG_BOOTSTRAP_CSS],
            IfcConstants::VERSION
        );
        $this->registerScript(
            IfcScripts::CORE_JS_SLUG,
            plugins_url($this->pluginRelPathToAssets.'/js/wp-menu-pages.js', $this->pluginBaseFile),
            ['jquery'],
            IfcConstants::VERSION,
            true
        );

        $this->registerStyle(IfcScripts::SLUG_FONT_AWESOME_CSS,IfcScripts::CDN_FONT_AWESOME_CSS, [], IfcConstants::VERSION);

        $this->registerStyle(
            IfcScripts::SLUG_SELECT2_CSS,
            IfcScripts::CDN_SELECT2_CSS,
            [],
            IfcConstants::VERSION
        );
        $this->registerScript(
            IfcScripts::SLUG_SELECT2_JS,
            IfcScripts::CDN_SELECT2_JS,
            ['jquery'],
            IfcConstants::VERSION,
            true
        );
    }

    public function registerStyle( $handle, $src, $deps = array(), $ver = false, $media = 'all' ) {
        return wp_register_style( $handle, $src, $deps, $ver, $media );
    }

    public function registerScript( $handle, $src, $deps = array(), $ver = false, $in_footer = false ) {
        return wp_register_script( $handle, $src, $deps, $ver, $in_footer );
    }

    public function enqueueStyle( $handle, $src = false, $deps = array(), $ver = false, $media = 'all' ) {
        wp_enqueue_style( $handle, $src, $deps, $ver, $media );
    }

    public function enqueueScript( $handle, $src = false, $deps = array(), $ver = false, $in_footer = false ) {
        wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
    }

    public function requireBootstrap() {
        $this->requiredScripts[IfcScripts::SLUG_BOOTSTRAP_JS] = IfcScripts::SLUG_BOOTSTRAP_JS;
        $this->requiredStyles[IfcScripts::SLUG_BOOTSTRAP_CSS] = IfcScripts::SLUG_BOOTSTRAP_CSS;
        $this->requiredStyles[IfcScripts::SLUG_BOOTSTRAP_THEME_CSS] = IfcScripts::SLUG_BOOTSTRAP_THEME_CSS;
        return $this;
    }

    public function requireFontAwesome(){
        $this->requiredStyles[IfcScripts::SLUG_FONT_AWESOME_CSS] = IfcScripts::SLUG_FONT_AWESOME_CSS;
        return $this;
    }

    public function requireSelect2() {
        $this->requiredStyles[IfcScripts::SLUG_SELECT2_CSS] = IfcScripts::SLUG_SELECT2_CSS;
        $this->requiredScripts[IfcScripts::SLUG_SELECT2_JS] = IfcScripts::SLUG_SELECT2_JS;
        return $this;
    }

    public function requireWpMenuPagesScripts(){
        $this->requiredScripts[IfcScripts::CORE_JS_SLUG] = IfcScripts::CORE_JS_SLUG;
        $this->requiredStyles[IfcScripts::CORE_CSS_SLUG] = IfcScripts::CORE_CSS_SLUG;
        return $this;
    }
}