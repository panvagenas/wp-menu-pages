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
    protected $slug = '';
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

    public function attachSection(AbsSection $section){
        $this->sections[] = $section;
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <Panagiotis.Vagenas@interactivedata.com>
     * @see    MenuPage::$sections
     * @codeCoverageIgnore
     */
    public function getSections() {
        return $this->sections;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <Panagiotis.Vagenas@interactivedata.com>
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
     * @author Panagiotis Vagenas <Panagiotis.Vagenas@interactivedata.com>
     * @codeCoverageIgnore
     */
    public function setSlug( $slug ) {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <Panagiotis.Vagenas@interactivedata.com>
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
     * @author Panagiotis Vagenas <Panagiotis.Vagenas@interactivedata.com>
     * @codeCoverageIgnore
     */
    public function setParent( $parent ) {
        $this->parent = $parent;

        return $this;
    }
}