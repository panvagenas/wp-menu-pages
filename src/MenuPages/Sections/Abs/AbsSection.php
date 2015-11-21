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
use Pan\MenuPages\Templates\Twig;
use Pan\MenuPages\Trt\TrtIdentifiable;

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
    use TrtIdentifiable;

    /**
     * ```php
     *  [
     *      $fieldId => Pan\MenuPages\Fields\Abs\AbsField $field
     *  ]
     * ```
     *
     * @var array
     */
    protected $fields = [ ];
    /**
     * @var MenuPage
     */
    protected $menuPage;

    /**
     * AbsSection constructor.
     *
     * @param MenuPage $menuPage
     *
     * @since  TODO ${VERSION}
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     */
    public function __construct( MenuPage $menuPage ) {
        $this->menuPage = $menuPage;
        $this->menuPage->attachSection( $this );
    }

    /**
     * @param AbsField $field
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function attachField( AbsField $field ) {
        if ( ! $this->hasField( $field ) ) {
            $this->fields[ $field->getHashId() ] = $field;
        }

        return $this;
    }

    /**
     * TODO Implement
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getMarkUp(){
        $out = '';
        foreach ( $this->fields as $field ) {
            /** AbsField $field */
            $out .= $field->getMarkUp();
        }
        return $out;
    }

    /**
     * @param AbsField $field
     *
     * @return bool
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function hasField( AbsField $field ) {
        return array_key_exists( $field->getHashId(), $this->fields );
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    AbsSection::$fields
     * @codeCoverageIgnore
     */
    public function getFields() {
        return $this->fields;
    }

    /**
     * @return Twig
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getTwig(){
        return $this->menuPage->getTwig();
    }
}