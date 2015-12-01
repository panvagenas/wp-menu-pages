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

use Pan\MenuPages\Fields\Trt\TrtGlobalAttributes;
use Pan\MenuPages\PageComponents\Section;
use Pan\MenuPages\Trt\TrtIdentifiable;

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
    use TrtIdentifiable, TrtGlobalAttributes;

    /**
     * @var Section
     */
    protected $section;

    /**
     * AbsField constructor.
     *
     * @param Section $section
     *
     * @since  TODO ${VERSION}
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     */
    public function __construct( Section $section ) {
        $this->section = $section;
        $this->section->attachField( $this );
    }

    /**
     * @return Section
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    AbsField::$section
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getSection() {
        return $this->section;
    }

    /**
     * @return \Pan\MenuPages\Templates\Twig
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getTwig() {
        return $this->section->getTwig();
    }
}