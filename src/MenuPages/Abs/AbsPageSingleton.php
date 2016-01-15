<?php
/**
 * AbsPageSingleton.php description
 *
 * @author    Panagiotis Vagenas <Panagiotis.Vagenas@interactivedata.com>
 * @date      2015-12-17
 * @version   $Id$
 * @package   Pan\MenuPages\Abs
 * @copyright Copyright (c) 2015 Interactive Data Managed Solutions Ltd
 */


namespace Pan\MenuPages\Abs;

use Pan\MenuPages\Pages\Abs\AbsMenuPage;

/**
 * Class AbsPageSingleton
 *
 * @author    Panagiotis Vagenas <Panagiotis.Vagenas@interactivedata.com>
 * @date      2015-12-17
 * @version   $Id$
 * @package   Pan\MenuPages\Abs
 * @copyright Copyright (c) 2015 Interactive Data Managed Solutions Ltd
 */
class AbsPageSingleton {
    /**
     * @var $this ::class The reference to *Singleton* instance of this class
     */
    private static $instances = array();
    /**
     * @var AbsMenuPage
     */
    protected $menuPage;
    /**
     * An instance-based reference to the global/static cache for the current blog ID & class extender
     *
     * **Should NOT be overridden by class extenders**
     *
     * @var array An instance-based reference to the global/static cache for the current blog ID & class extender
     */
    protected $static = array();

    /**
     * Protected constructor to prevent creating a new instance of the
     * *Singleton* via the `new` operator from outside of this class.
     *
     * @param AbsMenuPage $menuPage
     */
    protected function __construct( AbsMenuPage $menuPage ) {
        $this->menuPage = $menuPage;
    }

    /**
     * Returns the *Singleton* instance of this class.
     *
     * @param AbsMenuPage $menuPage
     *
     * @return $this ::class The *Singleton* instance.
     */
    public static function getInstance( AbsMenuPage $menuPage ) {
        $class = get_called_class();

        if ( ! isset( self::$instances[ $menuPage->getMenuSlug() ] ) ) {
            self::$instances[ $menuPage->getMenuSlug() ] = array();
        }

        if ( ! isset( self::$instances[ $menuPage->getMenuSlug() ][ $class ] ) ) {
            self::$instances[ $menuPage->getMenuSlug() ][ $class ] = new $class( $menuPage );
        }

        return self::$instances[ $menuPage->getMenuSlug() ][ $class ];
    }

    /**
     * Private clone method to prevent cloning of the instance of the
     * *Singleton* instance.
     *
     * @return void
     */
    protected function __clone() {
    }

    /**
     * Private un-serialize method to prevent un-serializing of the *Singleton*
     * instance.
     *
     * @return void
     */
    protected function __wakeup() {
    }
}