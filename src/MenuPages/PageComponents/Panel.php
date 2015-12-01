<?php
/**
 * Panel.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\PageComponents
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\PageComponents;

use Pan\MenuPages\Fields\Abs\AbsField;
use Pan\MenuPages\PageComponents\Abs\AbsMenuPageComponent;

/**
 * Class Panel
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\PageComponents
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class Panel extends AbsMenuPageComponent {
    protected $fields = [ ];

    /**
     * @param AbsField $field
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function attachField( AbsField $field ) {
        if ( ! $this->hasField( $field ) ) {
            $this->fields[ $field->getHashId() ] = $field;
        }

        return $this;
    }

    /**
     * @param AbsField $field
     *
     * @return bool
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function hasField( AbsField $field ) {
        return array_key_exists( $field->getHashId(), $this->fields );
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    AbsPanel::$fields
     * @codeCoverageIgnore
     */
    public function getFields() {
        return $this->fields;
    }
}