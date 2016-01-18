<?php

namespace Pan\MenuPages\Fields\Abs;

use Pan\MenuPages\Fields\Ifc\IfcInputConstants;
use Pan\MenuPages\Fields\Ifc\IfcValidation;
use Pan\MenuPages\Fields\Trt\TrtGlobalInputAttributes;
use Pan\MenuPages\PageElements\Components\Abs\AbsCmpFields;

abstract class AbsInputBase extends AbsField implements IfcValidation {
    use TrtGlobalInputAttributes;
    /**
     * @var string
     */
    protected $label;
    protected $description;

    /**
     * @inheritDoc
     */
    public function __construct( AbsCmpFields $component, $name ) {
        if ( ! preg_match( IfcInputConstants::INPUT_NAME_REGEX, $name ) ) {
            throw new \InvalidArgumentException( 'Invalid parameter $name="' . $name . '" in ' . __METHOD__ );
        }

        if ( $component->getMenuPage()->getInputFieldByName( $name ) ) {
            throw new \InvalidArgumentException( 'A field with the $name="' . $name . '" already registered' );
        }

        parent::__construct( $component );

        $this->name = $name;
        $this->id   = $name;

        $this->menuPageComponent->getMenuPage()->registerField( $this );
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @see    AbsInput::$label
     * @codeCoverageIgnore
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function setLabel( $label ) {
        $this->label = $label;

        return $this;
    }

    /**
     * @return mixed
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @see    AbsInputBase::$description
     * @codeCoverageIgnore
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param mixed $description
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function setDescription( $description ) {
        $this->description = $description;

        return $this;
    }
}
