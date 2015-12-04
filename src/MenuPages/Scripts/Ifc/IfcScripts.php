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
     * Bootstrap CSS Slug
     */
    const SLUG_BOOTSTRAP_CSS = 'wp-menu-pages-bs-css';

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
     * Bootstrap CSS CDN
     */
    const CDN_BOOTSTRAP_CSS = 'https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/cosmo/bootstrap.min.css';

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
}