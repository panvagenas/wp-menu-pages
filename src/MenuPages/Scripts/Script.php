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

    public function registerStyle( $handle, $src, $deps = array(), $ver = false, $media = 'all' ) {
        return wp_register_style( $handle, $src, $deps, $ver, $media );
    }

    public function registerScript( $handle, $src, $deps = array(), $ver = false, $in_footer = false ) {
        return wp_register_script( $handle, $src, $deps, $ver, $in_footer );
    }

    public function enqueueStyle( $handle, $src = false, $deps = array(), $ver = false, $media = 'all' ) {
        wp_enqueue_style( $handle, $src, $deps, $ver, $media );
    }

    public function enqueueScript( $handle, $src = false, $deps = array(), $ver = false, $media = 'all' ) {
        wp_enqueue_style( $handle, $src, $deps, $ver, $media );
    }

    public function requireBootstrap() {
    }

    public function requireSelect2() {
    }
}