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
     * @var Panel
     */
    protected $panel;

    /**
     * AbsField constructor.
     *
     * @param Panel $panel
     *
     * @since  TODO ${VERSION}
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     */
    public function __construct( Panel $panel ) {
        $this->panel = $panel;
        $this->panel->attachField( $this );
    }

    /**
     * @return Panel
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    AbsField::$panel
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getPanel() {
        return $this->panel;
    }

    /**
     * @return \Pan\MenuPages\Templates\Twig
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getTwig() {
        return $this->panel->getTwig();
    }
}