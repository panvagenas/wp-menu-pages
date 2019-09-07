<?php
/**
 * IfcRequirement.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2016-02-25
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields\Ifc
 * @copyright Copyright (c) 2016 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Fields\Ifc;

/**
 * Interface IfcRequirement
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2016-02-25
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields\Ifc
 * @copyright Copyright (c) 2016 Panagiotis Vagenas.
 */
interface IfcRequirement {
    const FULFILLED = 1;
    const NOT_FULFILLED = 0;

    /**
     * Returns the value of the requirement to be checked as a requirement for other fields
     *
     * @return mixed
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getValue();
}