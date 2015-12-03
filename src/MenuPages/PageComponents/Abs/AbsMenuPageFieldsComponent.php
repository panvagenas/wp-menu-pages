<?php

namespace Pan\MenuPages\PageComponents\Abs;

use Pan\MenuPages\Fields\Abs\AbsField;
use Pan\MenuPages\MenuPage;
use Pan\MenuPages\PageComponents\Elements\Form;

abstract class AbsMenuPageFieldsComponent extends AbsMenuPageComponent {
    protected $fields = [ ];
    /**
     * @var Form
     */
    protected $form;

    public function __construct( MenuPage $menuPage ) {
        parent::__construct( $menuPage );
        $this->form = new Form();
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
     * @see    AbsPanel::$fields
     * @codeCoverageIgnore
     */
    public function getFields() {
        return $this->fields;
    }

    /**
     * @return Form
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    AbsMenuPageFieldsComponent::$form
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getForm() {
        return $this->form;
    }

    /**
     * Setter for {@link AbsMenuPageFieldsComponent::$form}
     *
     * @param Form $form
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function setForm( $form ) {
        $this->form = $form;

        return $this;
    }
}