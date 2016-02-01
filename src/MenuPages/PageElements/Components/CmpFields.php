<?php
/**
 * CmpFields.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-12-04
 * @since     1.0.0
 * @package   Pan\MenuPages\PageComponents\Elements
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\PageElements\Components;

use Pan\MenuPages\PageElements\Components\Abs\AbsCmpFields;

/**
 * Class CmpFields
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-12-04
 * @since     1.0.0
 * @package   Pan\MenuPages\PageComponents\Elements
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class CmpFields extends AbsCmpFields {
    /**
     * @var string
     */
    protected $class = 'col-md-12';

    protected $templateName = 'fields-component.twig';

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    Plain::$class
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getClass() {
        return $this->class;
    }

    /**
     * Setter for {@link CmpFields::$class}
     *
     * @param string $class
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function setClass( $class ) {
        $this->class = $class;

        return $this;
    }
}