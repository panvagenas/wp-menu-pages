<?php
/**
 * PostType.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Fields;

use Pan\MenuPages\PageElements\Components\Abs\AbsFieldsComponent;

/**
 * Class PostType
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class PostType extends Select2 {
    public function __construct( AbsFieldsComponent $component, $name, $args = [] ) {
        parent::__construct( $component, $name );
        $postTypes = get_post_types($args, 'objects');
        foreach ( $postTypes as $postType ) {
            $this->options[$postType->label] = $postType->name;
        }
    }

    /**
     * Cannot set data for this field
     *
     * @param array $optionsData
     *
     * @return $this
     */
    public function setData( $optionsData ) {
        return $this;
    }
}