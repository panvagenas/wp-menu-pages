<?php
/**
 * AbsField.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Fields\Abs;

use Pan\MenuPages\Fields\Trt\TrtGlobalAttributes;
use Pan\MenuPages\PageComponents\Abs\AbsMenuPageFieldsComponent;
use Pan\MenuPages\PageComponents\Panel;
use Pan\MenuPages\Trt\TrtIdentifiable;

/**
 * Class AbsField
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
abstract class AbsField {
    use TrtIdentifiable, TrtGlobalAttributes;

    /**
     * @var AbsMenuPageFieldsComponent $component
     */
    protected $menuPageComponent;

    /**
     * AbsField constructor.
     *
     * @param AbsMenuPageFieldsComponent $component
     *
     * @since  TODO ${VERSION}
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     */
    public function __construct( AbsMenuPageFieldsComponent $component ) {
        $this->id = str_replace( '\\', '__', get_class( $this ) . '-' . $this->getHashId() );

        $this->menuPageComponent = $component;
        $this->menuPageComponent->attachField( $this );
    }

    /**
     * @return Panel
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    menuPageComponent::$panel
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getMenuPageComponent() {
        return $this->menuPageComponent;
    }

    /**
     * @return \Pan\MenuPages\Templates\Twig
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getTwig() {
        return $this->menuPageComponent->getTwig();
    }
}