<?php

namespace Pan\MenuPages\Trt;

trait TrtIdentifiable {
    use TrtStrings;

    protected $hashId = '';
    /**
     * A string to use as an id attr in html elements.
     * This is generated using {@link TrtStrings::pregReplaceNonAlphaNum()} and as $subject the concatenation of
     * {@link get_called_class()} . {@link TrtIdentifiable::getHashId()}
     *
     * @var string
     */
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
            $this->htmlId = $this->pregReplaceNonAlphaNum( get_called_class() . $this->getHashId(), '--' );
        }

        return $this->htmlId;
    }

    public function getHashId() {
        if ( ! $this->hashId ) {
            $this->hashId = spl_object_hash( $this );
        }

        return $this->hashId;
    }

    public function setId( $id ) {
        $this->id = htmlentities( $id );

        return $this;
    }
}