<?php

namespace Pan\MenuPages\Trt;

trait TrtIdentifiable {
    protected $hashId = '';
    protected $htmlId;
    protected $id;


    public function getHashId() {
        if ( ! $this->hashId ) {
            $this->hashId = spl_object_hash( $this );
        }

        return $this->hashId;
    }

    public function __clone() {
        $this->hashId = spl_object_hash( $this );
    }

    public function getHtmlId() {
        if(!$this->htmlId){
            $this->htmlId = preg_replace('/[^a-zA-Z0-9]/','--', get_called_class() . $this->getHashId());
        }

        return $this->htmlId;
    }

    public function getId() {
        if(!$this->id){
            $this->id = $this->htmlId;
        }

        return $this->id;
    }
}