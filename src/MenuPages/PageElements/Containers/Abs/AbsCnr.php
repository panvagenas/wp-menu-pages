<?php

namespace Pan\MenuPages\PageElements\Containers\Abs;

use Pan\MenuPages\PageElements\Abs\AbsElement;
use Pan\MenuPages\Pages\Abs\AbsMenuPage;
use Pan\MenuPages\Templates\Twig;

abstract class AbsCnr extends AbsElement {

    /**
     * @var \Pan\MenuPages\Pages\Abs\AbsMenuPage
     */
    protected $menuPage;
    protected $position;

    protected $templatesDir = 'containers';

    public function __construct( AbsMenuPage $menuPage, $position ) {
        $this->menuPage = $menuPage;
        $this->position = $position;
        $this->menuPage->attachContainer( $this, $position );
    }

    /**
     * @return AbsMenuPage
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @see    AbsMenuPageComponent::$menuPage
     * @codeCoverageIgnore
     */
    public function getMenuPage() {
        return $this->menuPage;
    }

    public function getOptions() {
        return $this->menuPage->getOptions();
    }

    /**
     * @return Twig
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function getTwig() {
        return $this->menuPage->getTwig();
    }

    public function getMarkUp( $echo = false ) {
        $markup = $this->getTwig()
                       ->getTwigEnvironment()
                       ->render( $this->getTemplateName(), [ 'cnr' => $this ] );

        if ( $echo ) {
            echo $markup;
        }

        return $markup;
    }

    /**
     * @return mixed
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    AbsContainer::$position
     * @codeCoverageIgnore
     */
    public function getPosition() {
        return $this->position;
    }

    /**
     * @param mixed $position
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @codeCoverageIgnore
     */
    public function setPosition( $position ) {
        $this->position = $position;

        return $this;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    AbsContainer::$templatesDir
     * @codeCoverageIgnore
     */
    public function getTemplatesDir() {
        return $this->templatesDir;
    }

    /**
     * @param string $templatesDir
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @codeCoverageIgnore
     */
    public function setTemplatesDir( $templatesDir ) {
        $this->templatesDir = $templatesDir;

        return $this;
    }
}