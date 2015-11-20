<?php

namespace Pan\MenuPages\Trt;

use Pan\MenuPages\Ifc\IfcConstants;

trait TrtCache {
    use TrtIdentifiable;

    protected static $_cache = [ ];

    protected function writeToCache( $key, $value ) {
        $this->initCache();
        self::$_cache[ $this->getHashId() ][ $key ] = $value;
    }

    protected function initCache() {
        if ( ! isset( self::$_cache[ $this->getHashId() ] ) ) {
            self::$_cache[ $this->getHashId() ] = [ ];
        }
    }

    protected function hasCacheKey( $key ) {
        return isset( self::$_cache[ $this->getHashId() ][ $key ] );
    }

    protected function getCacheValue( $key = null ) {
        if ( $key === null ) {
            return self::$_cache[ $this->getHashId() ];
        }
        if ( $this->hasFunctionCacheKey( $key ) ) {
            return self::$_cache[ $this->getHashId() ][ $key ];
        }

        return $key;
    }
}