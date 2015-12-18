<?php

namespace Pan\MenuPages\PageElements\Containers;

use Pan\MenuPages\PageElements\Containers\Abs\AbsContainer;

class Panel extends AbsContainer {
    protected $header = '';
    protected $body = '';
    protected $footer = '';

    protected $templateName = 'panel.twig';

    /**
     * @return mixed
     * @author Panagiotis Vagenas <Panagiotis.Vagenas@interactivedata.com>
     * @see    Panel::$header
     * @codeCoverageIgnore
     */
    public function getHeader() {
        return $this->header;
    }

    /**
     * @param mixed $header
     *
     * @return $this
     * @author Panagiotis Vagenas <Panagiotis.Vagenas@interactivedata.com>
     * @codeCoverageIgnore
     */
    public function setHeader( $header ) {
        $this->header = $header;

        return $this;
    }

    /**
     * @return mixed
     * @author Panagiotis Vagenas <Panagiotis.Vagenas@interactivedata.com>
     * @see    Panel::$body
     * @codeCoverageIgnore
     */
    public function getBody() {
        return $this->body;
    }

    /**
     * @param mixed $body
     *
     * @return $this
     * @author Panagiotis Vagenas <Panagiotis.Vagenas@interactivedata.com>
     * @codeCoverageIgnore
     */
    public function setBody( $body ) {
        $this->body = $body;

        return $this;
    }

    /**
     * @return mixed
     * @author Panagiotis Vagenas <Panagiotis.Vagenas@interactivedata.com>
     * @see    Panel::$footer
     * @codeCoverageIgnore
     */
    public function getFooter() {
        return $this->footer;
    }

    /**
     * @param mixed $footer
     *
     * @return $this
     * @author Panagiotis Vagenas <Panagiotis.Vagenas@interactivedata.com>
     * @codeCoverageIgnore
     */
    public function setFooter( $footer ) {
        $this->footer = $footer;

        return $this;
    }
}