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
    use TrtIdentifiable;

    protected $inputAttributes = [
        'accept',
        'alt',
        'autocomplete',
        'autofocus',
        'checked',
        'disabled',
        'form',
        'formaction',
        'formenctype',
        'formmethod',
        'formnovalidate',
        'formtarget',
        'height',
        'list',
        'max',
        'min',
        'maxlength',
        'multiple',
        'name',
        'pattern',
        'placeholder',
        'readonly',
        'required',
        'size',
        'src',
        'step',
        'type',
        'value',
        'width',
    ];

    /**
     * @var AbsSection
     */
    protected $section;

    /**
     * AbsField constructor.
     *
     * @param AbsSection $section
     *
     * @since  TODO ${VERSION}
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     */
    public function __construct( AbsSection $section ) {
        $this->section = $section;
        $this->section->attachField( $this );
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public abstract function getMarkUp();

    /**
     * @return AbsSection
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

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    protected function getAttributesArray(){
        $out = [];
        foreach ( $this->inputAttributes as $inputAttribute ) {
            if(isset($this->{$inputAttribute})){
                $out[$inputAttribute] = $this->{$inputAttribute};
            }
        }
        return $out;
    }
}