<?php
/**
 * AbsSection.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Sections
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Sections\Abs;

use Pan\MenuPages\Fields\Abs\AbsField;
use Pan\MenuPages\MenuPage;

/**
 * Class AbsSection
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Sections\Abstracts
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
abstract class AbsSection {
    /**
     * ```php
     *  [
     *      $fieldId => Pan\MenuPages\Fields\Abs\AbsField $section
     *  ]
     * ```
     *
     * @var array
     */
    protected $fields = [ ];

    public function attachField(AbsField $field){
        $this->fields = $field;
    }

    public function attachTo(MenuPage $menuPage){
        $menuPage->attachSection($this);
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <Panagiotis.Vagenas@interactivedata.com>
     * @see    AbsSection::$fields
     * @codeCoverageIgnore
     */
    public function getFields() {
        return $this->fields;
    }
}