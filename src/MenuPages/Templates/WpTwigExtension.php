<?php

namespace Pan\MenuPages\Templates;

use Pan\MenuPages\Pages\Abs\AbsMenuPage;

class WpTwigExtension extends \Twig_Extension {
    /**
     * @var AbsMenuPage
     */
    protected $menuPage;

    public function __construct( AbsMenuPage $menuPage ) {
        $this->menuPage = $menuPage;
    }

    public function getGlobals() {
        return [ 'menuPage' => $this->menuPage ];
    }

    public function getFunctions() {
        return [
            new \Twig_SimpleFunction( 'wp_action', [ $this, 'doAction' ] ),
        ];
    }

    public function getFilters() {
        return [
            new \Twig_SimpleFilter('wp_filter', [ $this, 'applyFilter' ])
        ];
    }

    public function applyFilter( $arg, $tag ) {
        return apply_filters($tag, $arg);
    }

    public function doAction( $tag, $arg = '') {
        call_user_func_array( 'do_action', func_get_args() );
    }

    /**
     * @inheritdoc
     */
    public function getName() {
        return 'wp_twig_extension';
    }
}