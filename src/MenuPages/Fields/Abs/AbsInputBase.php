<?php

namespace Pan\MenuPages\Fields\Abs;

use Pan\MenuPages\Fields\Trt\TrtGlobalInputAttributes;
use Pan\MenuPages\Fields\Trt\TrtTemplate;
use Pan\MenuPages\Fields\Trt\TrtValidation;
use Pan\MenuPages\PageComponents\Abs\AbsMenuPageFieldsComponent;

abstract class AbsInputBase extends AbsField {
    use TrtTemplate, TrtGlobalInputAttributes;
    /**
     * @var string
     */
    protected $label;

    /**
     * @inheritDoc
     */
    public function __construct( AbsMenuPageFieldsComponent $component, $name ) {
        parent::__construct( $component );
        $this->name  = $name;
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
     * Should return a validation result array as in {@link \Pan\MenuPages\Fields\Trt\TrtValidation::isValid()}
     * ```
     * [
     *      'value' => $value,
     *      'valid' => $valid,
     *      'errors' => $errors,
     * ]
     * ```
     *
     * @param $value
     *
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    abstract public function validate($value);
}
