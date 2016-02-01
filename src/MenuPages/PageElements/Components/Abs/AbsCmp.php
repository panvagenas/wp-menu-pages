<?php

namespace Pan\MenuPages\PageElements\Components\Abs;

use Pan\MenuPages\PageElements\Abs\AbsElement;
use Pan\MenuPages\PageElements\Containers\Abs\AbsCnrComponents;
use Pan\MenuPages\Templates\Twig;

/**
 * Class AbsCmp
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      ${YEAR}-${MONTH}-${DAY}
 * @since     1.0.0
 * @package   Pan\MenuPages\PageElements\Components\Abs
 * @copyright Copyright (c) ${YEAR} Panagiotis Vagenas
 */
abstract class AbsCmp extends AbsElement {
    /**
     * @var AbsCnrComponents
     */
    protected $container;

    /**
     * @var string
     */
    protected $templatesDir = 'components';

    /**
     * AbsCmp constructor.
     *
     * @param AbsCnrComponents $container
     * @param string           $containerPosition
     *
     * @since  1.0.0
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     */
    public function __construct(
        AbsCnrComponents $container,
        $containerPosition = AbsCnrComponents::CNR_BODY
    ) {
        $this->container = $container;
        $this->container->attachComponent( $this, $containerPosition );
    }

    /**
     * @return Twig
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function getTwig() {
        return $this->container->getTwig();
    }

    /**
     * @param bool $echo
     *
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
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