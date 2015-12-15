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

use Pan\MenuPages\Fields\Abs\AbsInputBase;
use Pan\MenuPages\Ifc\IfcConstants;
use Pan\MenuPages\PageComponents\Abs\AbsMenuPageComponent;
use Pan\MenuPages\PageComponents\Abs\AbsMenuPageFieldsComponent;
use Pan\MenuPages\PageComponents\Alert;
use Pan\MenuPages\PageComponents\Aside;
use Pan\MenuPages\PageComponents\Tab;
use Pan\MenuPages\Scripts\AjaxHandler;
use Pan\MenuPages\Scripts\Ifc\IfcScripts;
use Pan\MenuPages\Scripts\Script;
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
    const OPT_ACTIVE_TAB = 'activeTab';

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
    /**
     * @var WpMenuPages
     */
    protected $wpMenuPages;
    /**
     * @var string
     */
    protected $title;
    /**
     * @var string
     */
    protected $subtitle;
    /**
     * @var string
     */
    protected $templateName = 'base.twig';
    /**
     * @var string
     */
    protected $menuTitle;
    /**
     * @var string
     */
    protected $capability;
    /**
     * @var string
     */
    protected $menuSlug;
    /**
     * @var string
     */
    protected $iconUrl;
    /**
     * @var int
     */
    protected $position;
    /**
     * @var string
     */
    protected $hookSuffix;

    public function __construct(
        WpMenuPages $menuPages,
        $title,
        $menuTitle,
        $menuSlug,
        $parent = '',
        $capability = 'manage_options',
        $subtitle = '',
        $iconUrl = '',
        $position = null
    ) {
        $this->wpMenuPages = $menuPages;
        $this->options     = $menuPages->getOptions();
        $this->title       = $title;
        $this->subtitle    = $subtitle;
        $this->menuTitle   = $menuTitle;
        $this->capability  = $capability;
        $this->menuSlug    = $menuSlug;
        $this->iconUrl     = $iconUrl;
        $this->position    = $position;
        $this->parent      = $parent;

        $coreOptions = $this->options->get(IfcConstants::CORE_OPTIONS_KEY);

        if(!isset($coreOptions[$this->menuSlug])){
            $coreOptions[$this->menuSlug] = [];
            $this->options->set(IfcConstants::CORE_OPTIONS_KEY, $coreOptions);
        }

        add_action('admin_menu', [$this, 'init']);
        $this->bindActions();
    }

    public function init() {
        if ( $this->parent ) {
            $this->hookSuffix = add_submenu_page(
                $this->parent,
                $this->title,
                $this->menuTitle,
                $this->capability,
                $this->menuSlug,
                [ $this, 'display' ]
            );
        } else {
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

        $scripts = Script::getInstance($this);
        // TODO We should first check if request is for current page in order to avoid unecessary registrations
        $scripts->requireWpMenuPagesScripts();
        $scripts->requireFontAwesome();

        add_action( 'admin_print_scripts-' . $this->hookSuffix, [ $scripts, 'printScripts' ] );
    }

    protected function bindActions(){
        $scripts = Script::getInstance($this);

        if ( ! has_action( 'admin_init', [ $scripts, 'init' ] ) ) {
            add_action( 'admin_init', [ $scripts, 'init' ] );
        }

        add_action(
            'wp_ajax_'.IfcScripts::ACTION_SAVE_PREFIX.$this->menuSlug,
            [AjaxHandler::getInstance($this), 'saveOptions']
        );
        add_action(
            'wp_ajax_'.IfcScripts::ACTION_RESET_PREFIX.$this->menuSlug,
            [AjaxHandler::getInstance($this), 'resetOptions']
        );
        add_action(
            'wp_ajax_'.IfcScripts::ACTION_EXPORT_PREFIX.$this->menuSlug,
            [AjaxHandler::getInstance($this), 'exportOptions']
        );
        add_action(
            'wp_ajax_'.IfcScripts::ACTION_IMPORT_PREFIX.$this->menuSlug,
            [AjaxHandler::getInstance($this), 'importOptions']
        );
        add_action(
            'wp_ajax_'.IfcScripts::ACTION_UPDATE_CORE_OPTIONS_PREFIX.$this->menuSlug,
            [AjaxHandler::getInstance($this), 'updateCoreOptions']
        );
    }

    public function display() {
        echo $this->getMarkUp();
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

        foreach ( $this->components as $componentId => $component ) {
            if ( $component instanceof Tab ) {
                $context['tabs'][] = $component;
            } elseif ( $component instanceof Aside ) {
                $context['aside'] = $component;
            } elseif ( $component instanceof Alert ) {
                $context['alerts'][] = $component;
            } elseif ( $component instanceof PageComponents\Social ) {
                $context['socials'][] = $component;
            }
        }

        return $this->getTwig()->getTwigEnvironment()->render( $this->templateName, $context );
    }

    public function setPageOption($name, $value){
        $coreOptions = $this->options->get(IfcConstants::CORE_OPTIONS_KEY);
        $coreOptions[$this->menuSlug][$name] = $value;

        return $this->options->set(IfcConstants::CORE_OPTIONS_KEY, $coreOptions);
    }

    public function getPageOption($name){
        $coreOptions = $this->options->get(IfcConstants::CORE_OPTIONS_KEY);
        if(isset($coreOptions[$this->menuSlug][$name])){
            return $coreOptions[$this->menuSlug][$name];
        }
        return new \WP_Error('Option NOT Exists');
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

    public function getFieldByName($name){
        foreach ( $this->components as $component ) {
            if($component instanceof AbsMenuPageFieldsComponent){
                $field = $component->getFieldByName($name);
                if($field){
                    return $field;
                }
            }
        }
        return null;
    }

    public function getAllOptionFields(){
        $fields = [];
        foreach ( $this->components as $component ) {
            if($component instanceof AbsMenuPageFieldsComponent){
                $componentFields = $component->getFields();
                foreach ( $componentFields as $field ) {
                    if($field instanceof AbsInputBase){
                        $fields[$field->getName()] = $field;
                    }
                }
            }
        }
        return $fields;
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
     * @see    MenuPage::$menuSlug
     * @codeCoverageIgnore
     */
    public function getMenuSlug() {
        return $this->menuSlug;
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

    /**
     * @return WpMenuPages
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @see    MenuPage::$wpMenuPages
     * @codeCoverageIgnore
     */
    public function getWpMenuPages() {
        return $this->wpMenuPages;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @see    MenuPage::$capability
     * @codeCoverageIgnore
     */
    public function getCapability() {
        return $this->capability;
    }
}