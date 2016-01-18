<?php
/**
 * Taxonomies.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Fields;

use Pan\MenuPages\PageElements\Components\Abs\AbsCmpFields;

/**
 * Class Taxonomies
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class Taxonomies extends Select2 {
    public function __construct( AbsCmpFields $component, $name, $postType = 'post', $args = [ ] ) {
        parent::__construct( $component, $name );

        $taxonomies = get_object_taxonomies( $postType );

        if ( ! empty( $taxonomies ) ) {
            unset( $args['fields'] );
            $terms = get_terms( $taxonomies, $args );

            if ( ! is_wp_error( $terms ) ) {
                foreach ( $terms as $term ) {
                    $this->options[ $term->name ] = $term->term_id;
                }
            }
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