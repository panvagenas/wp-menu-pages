<?php
/**
 * AbsInput.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields\Abs
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Fields\Abs;

use Pan\MenuPages\Fields\Trt\TrtGlobalInputAttributes;
use Pan\MenuPages\Fields\Trt\TrtInputAttributes;
use Pan\MenuPages\Fields\Trt\TrtTemplate;
use Pan\MenuPages\PageComponents\Abs\AbsMenuPageFieldsComponent;

/**
 * Class AbsInput
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields\Abs
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class AbsInput extends AbsField {
    use TrtTemplate, TrtInputAttributes, TrtGlobalInputAttributes;
    /**
     * @var string
     */
    protected $label;

    /**
     * @inheritDoc
     */
    public function getTemplateName() {
        return 'fields/input.twig';
    }

    /**
     * @inheritDoc
     */
    public function __construct( AbsMenuPageFieldsComponent $component, $name ) {
        parent::__construct( $component );
        $this->name  = $name;
        $this->value = $this->getValue();
        $this->setClass( 'form-control' );
    }

    public function getValue() {
        return $this->menuPageComponent->getOptions()->get( $this->name );
    }

    public function getDefaultValue() {
        return $this->menuPageComponent->getOptions()->def( $this->name );
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
}