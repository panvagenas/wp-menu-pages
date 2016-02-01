<?php
/**
 * Nonce.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     1.0.0
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Fields;

use Pan\MenuPages\PageElements\Components\Abs\AbsCmpFields;

/**
 * Class Nonce
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     1.0.0
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class Nonce extends Raw {
    /**
     * @var string
     */
    protected $name = '_wpnonce';
    /**
     * @var int|string
     */
    protected $action = - 1;
    /**
     * @var bool
     */
    protected $referrer = true;

    /**
     * Nonce constructor.
     *
     * @param AbsCmpFields $component
     * @param int|string   $action
     * @param string       $name
     * @param bool         $referrer
     */
    public function __construct( AbsCmpFields $component, $action = - 1, $name = '_wpnonce', $referrer = true ) {
        parent::__construct( $component );

        $this->name     = $name;
        $this->action   = $action;
        $this->referrer = $referrer;
    }

    public function getContent() {
        return wp_nonce_field( $this->action, $this->name, $this->referrer, false );
    }
}