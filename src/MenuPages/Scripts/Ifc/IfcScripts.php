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
    const ASSETS_FOLDER = 'assets';
    const CORE_JS_SLUG = 'wp-menu-pages-js';
    const CORE_CSS_SLUG = 'wp-menu-pages-css';
    const CORE_JS_DEFINITIONS = 'wpMenuPagesDefinitions';

    const ACTION_SAVE_PREFIX = 'wp-menu-pages-save-options-';
    const ACTION_RESET_PREFIX = 'wp-menu-pages-reset-options-';
    const ACTION_EXPORT_PREFIX = 'wp-menu-pages-export-options-';
    const ACTION_IMPORT_PREFIX = 'wp-menu-pages-import-options-';

    /**
     * Bootstrap CSS Slug
     */
    const SLUG_BOOTSTRAP_CSS = 'wp-menu-pages-bs-css';

    /**
     * Bootstrap CSS Slug
     */
    const SLUG_BOOTSTRAP_THEME_CSS = 'wp-menu-pages-bs-theme-css';

    /**
     * Bootstrap JS Slug
     */
    const SLUG_BOOTSTRAP_JS = 'wp-menu-pages-bs-js';

    /**
     * Select2 CSS Slug
     */
    const SLUG_SELECT2_CSS = 'wp-menu-pages-select2-css';

    /**
     * Select2 JS Slug
     */
    const SLUG_SELECT2_JS = 'wp-menu-pages-select2-js';

    /**
     * FontAwesome CSS Slug
     */
    const SLUG_FONT_AWESOME_CSS = 'wp-menu-pages-font-awesome-css';

    /**
     * Bootstrap JS CDN
     */
    const CDN_BOOTSTRAP_JS = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js';

    /**
     * Select2 CSS CDN
     */
    const CDN_SELECT2_CSS = 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css';

    /**
     * Select2 JS CDN
     */
    const CDN_SELECT2_JS = 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.full.min.js';

    /**
     * FontAwesome CSS CDN
     */
    const CDN_FONT_AWESOME_CSS = 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css';
}