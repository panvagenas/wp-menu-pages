<?php

namespace Pan\MenuPages\PageElements\Collections\Abs;

use Pan\MenuPages\PageElements\Abs\AbsElement;
use Pan\MenuPages\Pages\Abs\AbsMenuPage;
use Pan\MenuPages\Templates\Twig;

abstract class AbsCln extends AbsElement{
    protected $templatesDir = 'collections';
    protected $templateName = 'cln.twig';

    protected $items = [];
    /**
     * @var \Pan\MenuPages\Pages\Abs\AbsMenuPage
     */
    protected $menuPage;

    public function __construct(AbsMenuPage $menuPage, $options = []) {
        $this->menuPage = $menuPage;
        $this->setUp($options);
    }

    protected abstract function setUp($options = []);

    /**
     * @return array
     * @author Panagiotis Vagenas <Panagiotis.Vagenas@interactivedata.com>
     * @see    AbsCln::$items
     * @codeCoverageIgnore
     */
    public function getItems() {
        return $this->items;
    }

    public function getMarkUp( $echo = false ) {
        $markup = $this->getTwig()
                       ->getTwigEnvironment()
                       ->render( $this->getTemplateName(), [ 'cln' => $this ] );

        if ( $echo ) {
            echo $markup;
        }

        return $markup;
    }

    /**
     * @return Twig
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function getTwig() {
        return $this->menuPage->getTwig();
    }
}