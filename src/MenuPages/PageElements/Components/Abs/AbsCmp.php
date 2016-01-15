<?php

namespace Pan\MenuPages\PageElements\Components\Abs;

use Pan\MenuPages\PageElements\Abs\AbsElement;
use Pan\MenuPages\PageElements\Containers\Abs\AbsComponentsContainer;
use Pan\MenuPages\Templates\Twig;

/**
 * Class AbsCmp
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      ${YEAR}-${MONTH}-${DAY}
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\PageElements\Components\Abs
 * @copyright Copyright (c) ${YEAR} Panagiotis Vagenas
 */
abstract class AbsCmp extends AbsElement {
    /**
     * @var AbsComponentsContainer
     */
    protected $container;

    /**
     * @var string
     */
    protected $templatesDir = 'components';

    /**
     * AbsCmp constructor.
     *
     * @param AbsComponentsContainer $container
     * @param string                 $containerPosition
     *
     * @since  TODO ${VERSION}
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     */
    public function __construct(
        AbsComponentsContainer $container,
        $containerPosition = AbsComponentsContainer::EL_BODY
    ) {
        $this->container = $container;
        $this->container->attachComponent( $this, $containerPosition );
    }

    /**
     * @return Twig
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getTwig() {
        return $this->container->getTwig();
    }

    /**
     * @param bool $echo
     *
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getMarkUp( $echo = false ) {
        $markup = $this->getTwig()
                       ->getTwigEnvironment()
                       ->render( $this->getTemplateName(), [ 'cmp' => $this ] );

        if ( $echo ) {
            echo $markup;
        }

        return $markup;
    }
}