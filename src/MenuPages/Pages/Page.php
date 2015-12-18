<?php
/**
 * AbsMenuPage.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-18
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Pages;

use Pan\MenuPages\Ifc\IfcConstants;
use Pan\MenuPages\PageComponents;
use Pan\MenuPages\PageElements\Components\Abs\AbsComponent;
use Pan\MenuPages\PageElements\Components\Alert;
use Pan\MenuPages\PageElements\Components\Tab;
use Pan\MenuPages\PageElements\Containers\Aside;
use Pan\MenuPages\Pages\Abs\AbsMenuPage;

/**
 * Class AbsMenuPage
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-18
 * @package   Pan\MenuPages
 * @since     TODO ${VERSION}
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class Page extends AbsMenuPage{
    const OPT_ACTIVE_TAB = 'activeTab';
    protected $validCoreOptionKeys = [
        self::OPT_ACTIVE_TAB
    ];
    public function init() {
        $this->hookSuffix = add_menu_page(
            $this->title,
            $this->menuTitle,
            $this->capability,
            $this->menuSlug,
            [ $this, 'display' ],
            $this->iconUrl,
            $this->position
        );
    }

    public function getMarkUp() {
        $context = [
            'page'    => [ ],
            'form'    => [ ],
            'tabs'    => [ ],
            'aside'   => [ ],
            'alerts'  => [ ],
            'socials' => [ ],
            'pageOptions' => $this->options->get(IfcConstants::CORE_OPTIONS_KEY)[$this->menuSlug],
        ];

        if ( $this->title ) {
            $context['page']['title'] = $this->title;
        }
        if ( $this->subtitle ) {
            $context['page']['subtitle'] = $this->subtitle;
        }

        foreach ( $this->elements as $componentId => $component ) {
            if ( $component instanceof Tab ) {
                $context['tabs'][] = $component;
            } elseif ( $component instanceof Aside ) {
                $context['aside'] = $component;
            } elseif ( $component instanceof Alert ) {
                $context['alerts'][] = $component;
            } elseif ( $component instanceof \Pan\MenuPages\PageElements\Components\Social ) {
                $context['socials'][] = $component;
            }
        }

        return $this->getTwig()->getTwigEnvironment()->render( $this->templateName, $context );
    }

    /**
     * @param \Pan\MenuPages\PageElements\Components\Abs\AbsComponent $component
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function attachComponent( AbsComponent $component ) {
        parent::attachComponent($component);

        if($component instanceof Tab){
            $activeTab = $this->getPageOption(self::OPT_ACTIVE_TAB);
            if(!($activeTab instanceof \WP_Error)){
                $component->setActive($activeTab == $component->getTitle());
            } elseif ($component->isActive()){
                $this->setPageOption(self::OPT_ACTIVE_TAB, $component->getTitle());
            }
        }

        return $this;
    }

    protected function canAttachElement(AbsComponent $component){
        return true;
    }
}