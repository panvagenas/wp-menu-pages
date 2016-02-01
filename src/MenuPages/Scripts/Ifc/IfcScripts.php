<?php

namespace Pan\MenuPages\Scripts\Ifc;

use Pan\MenuPages\Ifc\IfcConstants;

/**
 * Interface IfcScripts
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      ${YEAR}-${MONTH}-${DAY}
 * @since     1.0.0
 * @package   Pan\MenuPages\Ifc
 * @copyright Copyright (c) ${YEAR} Panagiotis Vagenas.
 */
interface IfcScripts extends IfcConstants {
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
    const CORE_JS_OBJECT = 'wpMenuPagesDefinitions';

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

    /**
     *
     */
    const CDN_SELECT2_JS = 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.full.min.js';

    /**
     *
     */
    const CDN_BOOTSTRAP_JS = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js';

    /**
     *
     */
    const SLUG_FILE_SAVER_JS = 'wp-menu-pages-file-saver-js';

    /**
     *
     */
    const SLUG_BOOTSTRAP_JS = 'wp-menu-pages-bootstrap-js';

    /**
     *
     */
    const SLUG_MOMENT_JS = 'wp-menu-pages-moment-js';

    /**
     *
     */
    const SLUG_DATETIME_PICKER_JS = 'wp-menu-pages-date-time-picker-js';

    /**
     *
     */
    const SLUG_SELECT2_JS = 'wp-menu-pages-select-2-js';
}