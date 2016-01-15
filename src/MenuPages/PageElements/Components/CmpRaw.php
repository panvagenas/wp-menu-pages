<?php

namespace Pan\MenuPages\PageElements\Components;

use Pan\MenuPages\PageElements\Components\Abs\AbsCmp;

class CmpRaw extends AbsCmp{
    protected $content = '';
    protected $templateName = 'raw.twig';

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    Raw::$content
     * @codeCoverageIgnore
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @codeCoverageIgnore
     */
    public function setContent( $content ) {
        $this->content = $content;

        return $this;
    }
}