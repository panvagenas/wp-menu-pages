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
use Pan\MenuPages\PageElements\Components\Abs\AbsFieldsComponent;

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
    protected $type = 'button';

    public function __construct( AbsFieldsComponent $component, $name, $label ) {
        parent::__construct( $component, $name );
        $this->label = $label;
        $this->setClass( $this->class . ' btn' );
    }

    /**
     * @inheritDoc
     */
    public function getTemplateName() {
        return 'fields/button.twig';
    }
}