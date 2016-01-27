<?php

namespace Pan\MenuPages\PageElements\Components\Trt;

trait TrtTab {
    /**
     * @var string
     */
    protected $icon = '';
    /**
     * @var string
     */
    protected $title;

    public function getIcon() {
        return $this->icon;
    }

    public function setIcon( $icon ) {
        $this->icon = $icon;

        return $this;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle( $title ) {
        $this->title = $title;

        return $this;
    }
}