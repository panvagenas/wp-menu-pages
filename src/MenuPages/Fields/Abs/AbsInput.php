<?php
/**
 * AbsInput.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     1.0.0
 * @package   Pan\MenuPages\Fields\Abs
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Fields\Abs;

use Pan\MenuPages\Fields\Ifc\IfcRequirement;
use Pan\MenuPages\Fields\Trt\TrtInputAttributes;
use Pan\MenuPages\Fields\Trt\TrtValidation;
use Pan\MenuPages\PageElements\Components\Abs\AbsCmpFields;

/**
 * Class AbsInput
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     1.0.0
 * @package   Pan\MenuPages\Fields\Abs
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
abstract class AbsInput extends AbsInputBase implements IfcRequirement{
    use TrtInputAttributes, TrtValidation;

    /**
     * @inheritDoc
     */
    public function getTemplateName() {
        return 'fields/input.twig';
    }

    /**
     * @inheritDoc
     */
    public function __construct( AbsCmpFields $component, $name ) {
        parent::__construct( $component, $name );

        if ( ! $this->menuPageComponent->getOptions()->exists( $name ) ) {
            throw new \InvalidArgumentException( 'Option "' . $name . '" isn\'t defined' );
        }

        $this->value = $this->getValue();
    }

    public function getValue() {
        return $this->menuPageComponent->getOptions()->get( $this->name );
    }

    public function getDefaultValue() {
        return $this->menuPageComponent->getOptions()->def( $this->name );
    }

    /**
     * @inheritDoc
     */
    public function validate( $value ) {
        return $this->isValid( $value, $this->label ?: $this->name );
    }
}