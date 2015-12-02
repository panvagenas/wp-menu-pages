<?php
/**
 * MenuPage.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-18
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages;

use Pan\MenuPages\PageComponents\Abs\AbsMenuPageComponent;
use Pan\MenuPages\PageComponents\Alert;
use Pan\MenuPages\PageComponents\Aside;
use Pan\MenuPages\PageComponents\Tab;
use Pan\MenuPages\Templates\Twig;
use Pan\MenuPages\Trt\TrtCache;

/**
 * Class MenuPage
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-18
 * @package   Pan\MenuPages
 * @since     TODO ${VERSION}
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class MenuPage {
    use TrtCache;

    /**
     * @var string
     */
    protected $slug = '';
    /**
     * @var string
     */
    protected $parent = '';
    /**
     * @var array
     */
    protected $components = [ ];
    /**
     * @var Options
     */
    protected $options;

    protected $wpMenuPages;
    protected $title;
    protected $subtitle;
    protected $templateName = 'base.twig';

    public function __construct( WpMenuPages $menuPages, $title = '', $subtitle = '' ) {
        $this->wpMenuPages = $menuPages;
        $this->options     = $menuPages->getOptions();
        $this->title       = $title;
        $this->subtitle    = $subtitle;
    }

    /**
     * @return Options
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    MenuPage::$options
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getOptions() {
        return $this->options;
    }

    public function getMarkUp() {
        $context = [
            'page'   => [ ],
            'form'   => [ ],
            'tabs'   => [ ],
            'aside'  => [ ],
            'alerts' => [ ],
        ];

        if ( $this->title ) {
            $context['page']['title'] = $this->title;
        }
        if ( $this->subtitle ) {
            $context['page']['subtitle'] = $this->subtitle;
        }

        foreach ( $this->components as $componentId => $component ) {
            if ( $component instanceof Tab ) {
                $context['tabs'][] = $component;
            } elseif ( $component instanceof Aside ) {
                $context['aside'] = $component;
            } elseif ( $component instanceof Alert ) {
                $context['alerts'][] = $component;
            }
        }

        return $this->getTwig()->getTwigEnvironment()->render( $this->templateName, $context );
    }

    /**
     * @param AbsMenuPageComponent $component
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function attachComponent( AbsMenuPageComponent $component ) {
        if ( ! $this->hasComponent( $component ) ) {
            $this->components[] = $component;
        }

        return $this;
    }

    /**
     * @param AbsMenuPageComponent $component
     *
     * @return bool
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function hasComponent( AbsMenuPageComponent $component ) {
        return array_key_exists( $component->getHashId(), $this->components );
    }

    /**
     * @return array Of AbsMenuPageComponent
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    MenuPage::$components
     * @codeCoverageIgnore
     */
    public function getComponents() {
        return $this->components;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    MenuPage::$slug
     * @codeCoverageIgnore
     */
    public function getSlug() {
        return $this->slug;
    }

    /**
     * @param string $slug
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @codeCoverageIgnore
     */
    public function setSlug( $slug ) {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    MenuPage::$parent
     * @codeCoverageIgnore
     */
    public function getParent() {
        return $this->parent;
    }

    /**
     * @param string $parent
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @codeCoverageIgnore
     */
    public function setParent( $parent ) {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Twig
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getTwig() {
        if ( ! $this->hasCacheKey( __METHOD__ ) ) {
            $this->writeCache( __METHOD__, new Twig( $this->wpMenuPages ) );
        }

        return $this->readCache( __METHOD__ );
    }
}