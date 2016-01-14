<?php
/**
 * FieldsComponent.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-12-04
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\PageComponents\Elements
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\PageElements\Components;

use Pan\MenuPages\PageElements\Components\Abs\AbsFieldsComponent;

/**
 * Class FieldsComponent
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-12-04
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\PageComponents\Elements
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class FieldsComponent extends AbsFieldsComponent{
    /**
     * @var string
     */
    protected $class = 'col-md-12';

    protected $templateName = 'fields-component.twig';

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    Plain::$class
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getClass() {
        return $this->class;
    }

    /**
     * Setter for {@link FieldsComponent::$class}
     *
     * @param string $class
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function setClass( $class ) {
        $this->class = $class;

        return $this;
    }
}