<?php
/**
 * IfcValidator.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Validators
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Validators;

/**
 * Interface IfcValidator
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Validators
 * @copyright Copyright (c) 2015 Panagiotis Vagenas.
 */
interface IfcValidator {
	public function isValid($value);
}