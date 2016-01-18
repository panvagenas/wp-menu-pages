<?php
/**
 * Button.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Fields;

use Pan\MenuPages\Fields\Abs\AbsField;
use Pan\MenuPages\Fields\Trt\TrtGlobalInputAttributes;
use Pan\MenuPages\Fields\Trt\TrtInputAttributes;
use Pan\MenuPages\PageElements\Components\Abs\AbsCmpFields;

/**
 * Class Button
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class Button extends AbsField {
    use TrtInputAttributes, TrtGlobalInputAttributes;

    protected $type = 'button';
    protected $label;

    public function __construct( AbsCmpFields $component, $label ) {
        parent::__construct( $component );
        $this->label = $label;
        $this->setClass( $this->class . ' btn' );
    }

    /**
     * @inheritDoc
     */
    public function getTemplateName() {
        return 'fields/button.twig';
    }

    /**
     * @return string
     * @see    Button::$label
     * @codeCoverageIgnore
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return $this
     * @codeCoverageIgnore
     */
    public function setLabel( $label ) {
        $this->label = $label;

        return $this;
    }
}