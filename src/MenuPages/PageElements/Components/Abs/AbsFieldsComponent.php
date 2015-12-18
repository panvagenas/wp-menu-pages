<?php

namespace Pan\MenuPages\PageElements\Components\Abs;

use Pan\MenuPages\Fields\Abs\AbsField;

abstract class AbsFieldsComponent extends AbsComponent {
    protected $fields = [ ];

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
     * @param string $name
     *
     * @return null|\Pan\MenuPages\Fields\Abs\AbsInputBase
     * @author Panagiotis Vagenas <Panagiotis.Vagenas@interactivedata.com>
     */
    public function getFieldByName($name){
        foreach ( $this->fields as $field ) {
            /** \Pan\MenuPages\Fields\Abs\AbsInputBase $field */
            if($field->getName() === $name){
                return $field;
            }
        }
        return null;
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    AbsPanel::$fields
     * @codeCoverageIgnore
     */
    public function getFields() {
        return $this->fields;
    }
}