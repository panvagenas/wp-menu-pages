<?php

namespace Pan\MenuPages\Ifc;

use Pan\MenuPages\Templates\Twig;

/**
 * Interface IfcDisplayable
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      ${YEAR}-${MONTH}-${DAY}
 * @since     1.0.0
 * @package   Pan\MenuPages\Fields\Trt
 * @copyright Copyright (c) ${YEAR} Panagiotis Vagenas
 */
interface IfcDisplayable {
    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function getTemplateName();

    /**
     * @return Twig
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function getTwig();

    /**
     * @param bool $echo Echo the result?
     *
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     */
    public function getMarkUp( $echo = false );
}