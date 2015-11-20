<?php
/**
 * AbsField.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Fields\Abs;

use Pan\MenuPages\Sections\Abs\AbsSection;

/**
 * Class AbsField
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
abstract class AbsField {
    public abstract function getMarkUp();

    public function attachTo(AbsSection $section){
        $section->attachField($this);
    }
}