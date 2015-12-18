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
use Pan\MenuPages\PageElements\Containers\Abs\AbsContainer;
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
class Page extends AbsMenuPage {
    const OPT_ACTIVE_TAB = 'activeTab';

    protected $validCoreOptionKeys = [
        self::OPT_ACTIVE_TAB,
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
            'page'        => [ ],
            'main'        => [ ],
            'aside'     => [ ],
            'alerts'      => [ ],
            'pageOptions' => $this->options->get( IfcConstants::CORE_OPTIONS_KEY )[ $this->menuSlug ],
        ];

        if ( $this->title ) {
            $context['page']['title'] = $this->title;
        }
        if ( $this->subtitle ) {
            $context['page']['subtitle'] = $this->subtitle;
        }

        /**
         * @var string $containerId
         * @var  AbsContainer $container
         */
        foreach ( $this->containers as $containerId => $container ) {
            if($container->getPosition() === AbsContainer::POSITION_MAIN){
                $context['main'][] = $container;
            } elseif ($container->getPosition() === AbsContainer::POSITION_ASIDE){
                $context['aside'][] = $container;
            }
        }

        return $this->getTwig()->getTwigEnvironment()->render( $this->templateName, $context );
    }
}