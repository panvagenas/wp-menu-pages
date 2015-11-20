<?php

namespace Pan\MenuPages\Trt;

/**
 * Class TrtCache
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      ${YEAR}-${MONTH}-${DAY}
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Trt
 * @copyright Copyright (c) ${YEAR} Panagiotis Vagenas
 */
trait TrtCache {
    use TrtIdentifiable;

    /**
     * @var array
     */
    protected static $_cache = [ ];

    /**
     * @param $key
     * @param $value
     *
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    protected function writeCache( $key, $value ) {
        $this->initCache();
        self::$_cache[ $this->getHashId() ][ $key ] = $value;
    }

    /**
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    protected function initCache() {
        if ( ! isset( self::$_cache[ $this->getHashId() ] ) ) {
            self::$_cache[ $this->getHashId() ] = [ ];
        }
    }

    /**
     * @param null $key
     *
     * @return null
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    protected function readCache( $key = null ) {
        if ( $key === null ) {
            return self::$_cache[ $this->getHashId() ];
        }
        if ( $this->hasCacheKey( $key ) ) {
            return self::$_cache[ $this->getHashId() ][ $key ];
        }

        return $key;
    }

    /**
     * @param $key
     *
     * @return bool
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    protected function hasCacheKey( $key ) {
        return isset( self::$_cache[ $this->getHashId() ][ $key ] );
    }
}