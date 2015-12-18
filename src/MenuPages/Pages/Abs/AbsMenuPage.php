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

namespace Pan\MenuPages\Pages\Abs;

use Pan\MenuPages\Fields\Abs\AbsInputBase;
use Pan\MenuPages\Ifc\IfcConstants;
use Pan\MenuPages\Options;
use Pan\MenuPages\PageElements\Abs\AbsElement;
use Pan\MenuPages\PageElements\Components\Abs\AbsFieldsComponent;
use Pan\MenuPages\Scripts\AjaxHandler;
use Pan\MenuPages\Scripts\Ifc\IfcScripts;
use Pan\MenuPages\Scripts\Script;
use Pan\MenuPages\Templates\Twig;
use Pan\MenuPages\Trt\TrtCache;
use Pan\MenuPages\WpMenuPages;

/**
 * Class AbsMenuPage
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-18
 * @package   Pan\MenuPages
 * @since     TODO ${VERSION}
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
abstract class AbsMenuPage {
    use TrtCache;
    /**
     * @var array
     */
    protected $elements = [ ];
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

    protected $validCoreOptionKeys = [];

    public function __construct(
        WpMenuPages $menuPages,
        $menuTitle,
        $menuSlug = '',
        $title = '',
        $capability = 'manage_options',
        $subtitle = '',
        $iconUrl = '',
        $position = null
    ) {
        $this->wpMenuPages = $menuPages;
        $this->options     = $menuPages->getOptions();
        $this->title       = $title ? : $menuTitle;
        $this->subtitle    = $subtitle;
        $this->menuTitle   = $menuTitle;
        $this->capability  = $capability;
        $this->menuSlug    = $menuSlug ? : preg_replace('/[^a-zA-Z]/', '_', $menuTitle);
        $this->iconUrl     = $iconUrl;
        $this->position    = $position;

        $coreOptions = $this->options->get(IfcConstants::CORE_OPTIONS_KEY);
        $menuPages->attachMenuPage($this);

        if(!isset($coreOptions[$this->menuSlug])){
            $coreOptions[$this->menuSlug] = [];
            $this->options->set(IfcConstants::CORE_OPTIONS_KEY, $coreOptions);
        }

        add_action('admin_menu', [$this, 'init'], 10);
        add_action('admin_menu', [$this, 'bindScripts'], 11);
        $this->bindActions();
    }

    abstract public function init();

    public function bindScripts(){
        if(!$this->hookSuffix){
            throw  new \RuntimeException('A page hook suffix should be first set');
        }

        $scripts = Script::getInstance($this);
        // TODO We should first check if request is for current page in order to avoid unnecessary registrations
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

    abstract public function getMarkUp();

    public function setPageOption($name, $value){
        $coreOptions = $this->options->get(IfcConstants::CORE_OPTIONS_KEY);
        $coreOptions[$this->menuSlug][$name] = $value;

        return $this->options->set(IfcConstants::CORE_OPTIONS_KEY, $coreOptions);
    }

    public function isValidOption($name, $value){
        return in_array($name, $this->validCoreOptionKeys) && is_string($value);
    }

    public function getPageOption($name){
        $coreOptions = $this->options->get(IfcConstants::CORE_OPTIONS_KEY);
        if(isset($coreOptions[$this->menuSlug][$name])){
            return $coreOptions[$this->menuSlug][$name];
        }
        return new \WP_Error('Option NOT Exists');
    }

    /**
     * @param AbsElement $element
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function attachElement( AbsElement $element ) {
        if(!$this->canAttachElement($element)){
            return $this;
        }

        if ( ! $this->hasElement( $element ) ) {
            $this->elements[] = $element;
        }

        return $this;
    }

    abstract protected function canAttachElement(AbsElement $component);

    public function getFieldByName($name){
        foreach ( $this->elements as $component ) {
            if( $component instanceof AbsFieldsComponent){
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
        foreach ( $this->elements as $element ) {
            if( $element instanceof AbsFieldsComponent){
                $componentFields = $element->getFields();
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
     * @param AbsElement $element
     *
     * @return bool
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function hasElement( AbsElement $element ) {
        return array_key_exists( $element->getHashId(), $this->elements );
    }

    /**
     * @return array Of AbsComponent
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    MenuPage::$components
     * @codeCoverageIgnore
     */
    public function getElements() {
        return $this->elements;
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