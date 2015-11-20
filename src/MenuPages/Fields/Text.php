<?php
/**
 * Text.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Fields;

use Pan\MenuPages\Fields\Abs\AbsField;
use Pan\MenuPages\Fields\Trt\TrtGlobalAttributes;
use Pan\MenuPages\Fields\Trt\TrtInputAttributes;
use Pan\MenuPages\Fields\Trt\TrtTemplate;
use Pan\MenuPages\Sections\Abs\AbsSection;

/**
 * Class Text
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class Text extends AbsField {
    use TrtTemplate, TrtInputAttributes, TrtGlobalAttributes;
    /**
     * @var string
     */
    protected $templateName = 'fields/text.twig';

    /**
     * @inheritDoc
     */
    public function __construct( AbsSection $section, $name, $value = '' ) {
        parent::__construct( $section );
        $this->name  = $name;
        $this->value = $value;
    }


    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getMarkUp() {
        return $this->getTwig()
                    ->getTwigEnvironment()
                    ->render( $this->getTemplateName(), $this->getAttributesArray() );
    }

    /**
     * @inheritDoc
     */
    public function getTemplateName() {
        return $this->templateName;
    }
}