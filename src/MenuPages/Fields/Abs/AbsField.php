<?php
/**
 * AbsField.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     1.0.0
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Fields\Abs;

use Pan\MenuPages\Fields\Trt\TrtGlobalAttributes;
use Pan\MenuPages\Ifc\IfcDisplayable;
use Pan\MenuPages\PageElements\Components\Abs\AbsCmpFields;
use Pan\MenuPages\Trt\TrtIdentifiable;

/**
 * Class AbsField
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     1.0.0
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
abstract class AbsField implements IfcDisplayable {
    use TrtIdentifiable, TrtGlobalAttributes;

    /**
     * @var AbsCmpFields $component
     */
    protected $menuPageComponent;

    /**
     * AbsField constructor.
     *
     * @param AbsCmpFields $component
     *
     * @since  1.0.0
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     */
    public function __construct( AbsCmpFields $component ) {
        $this->id = str_replace( '\\', '__', get_class( $this ) . '-' . $this->getHashId() );

        $this->menuPageComponent = $component;
        $this->menuPageComponent->attachField( $this );
    }

    /**
     * @inheritDoc
     */
    public function getMarkUp( $echo = false ) {
        return $this->getTwig()->getTwigEnvironment()->render( $this->getTemplateName(), [ 'fld' => $this ] );
    }

    /**
     * @return AbsCmpFields
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    menuPageComponent::$panel
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getMenuPageComponent() {
        return $this->menuPageComponent;
    }

    /**
     * @return \Pan\MenuPages\Templates\Twig
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function getTwig() {
        return $this->menuPageComponent->getTwig();
    }
}