<?php

namespace Pan\MenuPages\Trt;

trait TrtIdentifiable {
    protected $hashId = '';


    public function getHashId() {
        if ( $this->hashId ) {
            $this->hashId = spl_object_hash( $this );
        }

        return $this->hashId;
    }
}