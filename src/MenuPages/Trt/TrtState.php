<?php

namespace Pan\MenuPages\Trt;

trait TrtState {
    protected $active = false;

    public function toggleState( $save = true ) {
        $this->active = ! $this->active;
        if ( $save ) {
            $this->saveState();
        }

        return $this;
    }

    /**
     * @return boolean
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    active::$state
     * @codeCoverageIgnore
     */
    public function isActive() {
        return $this->active;
    }

    /**
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @codeCoverageIgnore
     */
    public function setActive( $save = true ) {
        $this->active = true;
        if ( $save ) {
            $this->saveState();
        }

        return $this;
    }

    /**
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @codeCoverageIgnore
     */
    public function setInactive( $save = true ) {
        $this->active = false;
        if ( $save ) {
            $this->saveState();
        }

        return $this;
    }

    abstract public function saveState();
}