<?php

namespace Pan\MenuPages\Fields\Ifc;

use Pan\MenuPages\Ifc\IfcConstants;

/**
 * Interface IfcInputConstants
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      ${YEAR}-${MONTH}-${DAY}
 * @since     1.0.0
 * @package   Pan\MenuPages\Fields\Trt
 * @copyright Copyright (c) ${YEAR} Panagiotis Vagenas
 */
interface IfcInputConstants extends IfcConstants {
    const INPUT_NAME_REGEX = '/^[a-zA-Z]+\w*$/';
}