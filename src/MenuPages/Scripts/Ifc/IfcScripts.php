<?php

namespace Pan\MenuPages\Scripts\Ifc;

use Pan\MenuPages\Ifc\IfcConstants;

/**
 * Interface IfcScripts
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      ${YEAR}-${MONTH}-${DAY}
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Ifc
 * @copyright Copyright (c) ${YEAR} Panagiotis Vagenas.
 */
interface IfcScripts extends IfcConstants{
    /**
     *
     */
    const ASSETS_FOLDER = 'assets';
    /**
     *
     */
    const CORE_JS_SLUG = 'wp-menu-pages-js';
    /**
     *
     */
    const REQUIRE_JS_SLUG = 'require-js';
    /**
     *
     */
    const CORE_CSS_SLUG = 'wp-menu-pages-css';
    /**
     *
     */
    const CORE_JS_DEFINITIONS = 'wpMenuPagesDefinitions';
    /**
     *
     */
    const CORE_JS_OBJECT = 'wpMenuPages';

    /**
     *
     */
    const ACTION_SAVE_PREFIX = 'wp-menu-pages-save-options-';
    /**
     *
     */
    const ACTION_RESET_PREFIX = 'wp-menu-pages-reset-options-';
    /**
     *
     */
    const ACTION_EXPORT_PREFIX = 'wp-menu-pages-export-options-';
    /**
     *
     */
    const ACTION_IMPORT_PREFIX = 'wp-menu-pages-import-options-';
    /**
     *
     */
    const ACTION_UPDATE_CORE_OPTIONS_PREFIX = 'wp-menu-pages-update-core-options-';

    /**
     * Select2 CSS Slug
     */
    const SLUG_SELECT2_CSS = 'wp-menu-pages-select2-css';

    /**
     * FontAwesome CSS Slug
     */
    const SLUG_FONT_AWESOME_CSS = 'wp-menu-pages-font-awesome-css';

    /**
     * FontAwesome CSS CDN
     */
    const CDN_FONT_AWESOME_CSS = 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css';
}