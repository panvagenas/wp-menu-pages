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

use Pan\MenuPages\Fields\Abs\AbsInput;
use Pan\MenuPages\Sections\Abs\AbsSection;

/**
 * Class Button
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class Button extends AbsInput {
    protected $type = 'button';

    public function __construct( AbsSection $section, $name, $label ) {
        parent::__construct( $section, $name, $label );
        $this->label = $label;
    }

    /**
     * @inheritDoc
     */
    public function getTemplateName() {
        return 'fields/abs/button.twig';
    }
}