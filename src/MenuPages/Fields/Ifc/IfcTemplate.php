<?php

namespace Pan\MenuPages\Fields\Ifc;

use Pan\MenuPages\Templates\Twig;

/**
 * Interface IfcTemplate
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      ${YEAR}-${MONTH}-${DAY}
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields\Trt
 * @copyright Copyright (c) ${YEAR} Panagiotis Vagenas
 */
interface IfcTemplate {
    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getTemplateName();

    /**
     * @return Twig
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getTwig();
}