<?php

namespace Pan\MenuPages\Trt;

trait TrtIdentifiable {
    protected $hashId = '';
    protected $htmlId;
    protected $id;

    public function __clone() {
        $this->hashId = spl_object_hash( $this );
    }

    public function getId() {
        if ( ! $this->id ) {
            $this->id = $this->getHtmlId();
        }

        return $this->id;
    }

    public function getHtmlId() {
        if ( ! $this->htmlId ) {
            $this->htmlId = preg_replace( '/[^a-zA-Z0-9]/', '--', get_called_class() . $this->getHashId() );
        }

        return $this->htmlId;
    }

    public function getHashId() {
        if ( ! $this->hashId ) {
            $this->hashId = spl_object_hash( $this );
        }

        return $this->hashId;
    }
}