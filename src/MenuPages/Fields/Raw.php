<?php
/**
 * Raw.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Fields;

use Pan\MenuPages\Fields\Abs\AbsField;
use Pan\MenuPages\PageElements\Components\Abs\AbsFldCmp;

/**
 * Class Raw
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class Raw extends AbsField {
    protected $content;

    public function __construct( AbsFldCmp $component ) {
        parent::__construct( $component );
        $this->setClass( 'col-md-12' );
    }


    /**
     * @return mixed
     * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see       Raw::$content
     * @since     TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * @param mixed $content
     *
     * @return $this
     * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since     TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function setContent( $content ) {
        $this->content = $content;

        return $this;
    }

    public function getTemplateName() {
        return 'fields/raw.twig';
    }
}