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

use Pan\MenuPages\Sections\Abs\AbsSection;
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
     * ```php
     *  [
     *      $sectionId => Pan\MenuPages\Sections\Abs\AbsSection $section
     *  ]
     * ```
     *
     * @var array
     */
    protected $sections = [ ];
    /**
     * @var Options
     */
    protected $options;

    protected $wpMenuPages;

    public function __construct(WpMenuPages $menuPages) {
        $this->wpMenuPages = $menuPages;
        $this->options = $menuPages->getOptions();
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

    /**
     * @param AbsSection $section
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function attachSection( AbsSection $section ) {
        if ( ! $this->hasSection( $section ) ) {
            $this->sections[] = $section;
        }

        return $this;
    }

    /**
     * @param AbsSection $section
     *
     * @return bool
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function hasSection( AbsSection $section ) {
        return array_key_exists( $section->getHashId(), $this->sections );
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    MenuPage::$sections
     * @codeCoverageIgnore
     */
    public function getSections() {
        return $this->sections;
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
            $this->writeCache( __METHOD__, new Twig($this->wpMenuPages) );
        }

        return $this->readCache( __METHOD__ );
    }
}