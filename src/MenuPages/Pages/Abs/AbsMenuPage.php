<?php
/**
 * AbsMenuPage.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-18
 * @since     1.0.0
 * @package   Pan\MenuPages
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Pages\Abs;

use Pan\MenuPages\Fields\Abs\AbsField;
use Pan\MenuPages\Fields\Abs\AbsInputBase;
use Pan\MenuPages\Options;
use Pan\MenuPages\PageElements\Containers\Abs\AbsCnr;
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
 * @since     1.0.0
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
abstract class AbsMenuPage {
    use TrtCache;

    /**
     *  Main area of the page
     */
    const POSITION_MAIN = 'main';

    /**
     * Aside area of the page
     */
    const POSITION_ASIDE = 'aside';

    /**
     * Header area of the page
     */
    const POSITION_HEADER = 'header';

    /**
     * Footer area of the page
     */
    const POSITION_FOOTER = 'footer';

    /**
     * Holds all containers that were assigned to this page.
     * Each page area has its own key in this array.
     *
     * @var array
     */
    protected $containers = [
        self::POSITION_HEADER => [ ],
        self::POSITION_MAIN   => [ ],
        self::POSITION_ASIDE  => [ ],
        self::POSITION_FOOTER => [ ],
    ];
    /**
     * An instance of the plugin options
     *
     * @var Options
     */
    protected $options;
    /**
     * @var WpMenuPages
     */
    protected $wpMenuPages;
    /**
     * The title of the page. This is visible at the page header.
     *
     * @var string
     */
    protected $title;
    /**
     * The page subtitle. This is visible at the page header.
     *
     * @var string
     */
    protected $subtitle;
    /**
     * The template to use for page rendering
     *
     * @var string
     */
    protected $templateName = 'page.twig';
    /**
     * The menu title for this page
     *
     * @var string
     */
    protected $menuTitle;
    /**
     * The capability that is required to see this page
     *
     * @var string
     */
    protected $capability;
    /**
     * A unique identifier for this page
     *
     * @var string
     */
    protected $menuSlug;
    /**
     * A URL pointing to an icon that will be used as the page icon.
     * See WordPress {@link add_menu_page()} params
     *
     * @var string
     */
    protected $iconUrl;
    /**
     * The position of the page.
     * See WordPress {@link add_menu_page()} params
     *
     * @var int
     */
    protected $position;
    /**
     * This is generated from WordPress upon initialization.
     *
     * @var string
     */
    protected $hookSuffix;
    /**
     * Holds fields registered to this page
     *
     * @var array
     */
    protected $fields = [ ];

    /**
     * AbsMenuPage constructor.
     *
     * @param WpMenuPages $menuPages
     * @param             $menuTitle
     * @param string      $menuSlug
     * @param string      $title
     * @param string      $capability
     * @param string      $subtitle
     * @param string      $iconUrl
     * @param null        $position
     *
     * @since  1.0.0
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     */
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
        $this->title       = $title ?: $menuTitle;
        $this->subtitle    = $subtitle;
        $this->menuTitle   = $menuTitle;
        $this->capability  = $capability;
        $this->menuSlug    = $menuSlug ?: preg_replace( '/[^a-zA-Z]/', '_', $menuTitle );
        $this->iconUrl     = $iconUrl;
        $this->position    = $position;

        $this->options->maybeInitPageOptions( $this );

        add_action( 'admin_menu', [ $this, 'init' ], 10 );
        add_action( 'admin_menu', [ $this, 'bindScripts' ], 11 );
        $this->bindActions();
    }

    /**
     * This should set the {@link AbsMenuPage::$hookSuffix} property in child classes
     *
     * @return mixed
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    abstract public function init();

    /**
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function bindScripts() {
        if ( ! current_user_can( $this->capability ) ) {
            return;
        }

        if ( ! $this->hookSuffix ) {
            throw  new \RuntimeException( 'A page hook suffix should be first set' );
        }

        add_action( 'admin_print_scripts-' . $this->hookSuffix, [ Script::getInstance( $this ), 'printScripts' ] );
    }

    /**
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    protected function bindActions() {
        $scripts = Script::getInstance( $this );

        if ( ! has_action( 'admin_init', [ $scripts, 'init' ] ) ) {
            add_action( 'admin_init', [ $scripts, 'init' ] );
        }

        add_action(
            'wp_ajax_' . IfcScripts::ACTION_SAVE_PREFIX . $this->menuSlug,
            [ AjaxHandler::getInstance( $this ), 'saveOptions' ]
        );
        add_action(
            'wp_ajax_' . IfcScripts::ACTION_RESET_PREFIX . $this->menuSlug,
            [ AjaxHandler::getInstance( $this ), 'resetOptions' ]
        );
        add_action(
            'wp_ajax_' . IfcScripts::ACTION_EXPORT_PREFIX . $this->menuSlug,
            [ AjaxHandler::getInstance( $this ), 'exportOptions' ]
        );
        add_action(
            'wp_ajax_' . IfcScripts::ACTION_IMPORT_PREFIX . $this->menuSlug,
            [ AjaxHandler::getInstance( $this ), 'importOptions' ]
        );
        add_action(
            'wp_ajax_' . IfcScripts::ACTION_UPDATE_CORE_OPTIONS_PREFIX . $this->menuSlug,
            [ AjaxHandler::getInstance( $this ), 'updateCoreOptions' ]
        );
    }

    /**
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function display() {
        echo $this->getMarkUp();
    }

    /**
     * @return Options
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    MenuPage::$options
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getOptions() {
        return $this->options;
    }

    /**
     * @return mixed
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    abstract public function getMarkUp();

    /**
     * @param $name
     * @param $value
     *
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setPageOption( $name, $value ) {
        $this->options->setPageOption( $this, $name, $value );
    }

    public function getElementState( $elIdentifier ) {
        $states = $this->getPageOption( Options::PAGE_OPT_STATE, [ ] );

        return isset( $states[ $elIdentifier ] ) ? $states[ $elIdentifier ] : null;
    }

    public function setElementState( $elIdentifier, $state ) {
        $states = $this->getPageOption( Options::PAGE_OPT_STATE, [ ] );

        $states[ $elIdentifier ] = $state;

        $this->setPageOption( Options::PAGE_OPT_STATE, $states );
    }

    /**
     * @param      $name
     * @param null $default
     *
     * @return null
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function getPageOption( $name, $default = null ) {
        return $this->options->getPageOption( $this, $name, $default );
    }

    /**
     * @param AbsCnr $container
     * @param string $position
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function attachContainer( AbsCnr $container, $position = self::POSITION_MAIN ) {
        if ( $this->isProperPosition( $position ) && ! $this->hasContainer( $container, $position ) ) {
            $this->containers[ $position ][] = $container;
        }

        return $this;
    }

    /**
     * @param $position
     *
     * @return bool
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    protected function isProperPosition( $position ) {
        return in_array( $position,
            [ self::POSITION_MAIN, self::POSITION_ASIDE, self::POSITION_FOOTER, self::POSITION_HEADER ]
        );
    }

    public function registerField( AbsField $field ) {
        $this->fields[ $field->getHashId() ] = $field;
    }

    /**
     * @param $fieldName
     *
     * @return null|AbsInputBase
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function getInputFieldByName( $fieldName ) {
        if ( empty( $fieldName ) || ! is_string( $fieldName ) ) {
            return null;
        }
        /** @var AbsInputBase $field */
        foreach ( $this->fields as $field ) {
            if ( $field instanceof AbsInputBase && $field->getName() === $fieldName ) {
                return $field;
            }
        }

        return null;
    }

    /**
     * @return array
     * @see    AbsMenuPage::$fields
     * @codeCoverageIgnore
     */
    public function getFields() {
        return $this->fields;
    }

    /**
     * @param AbsCnr       $container
     * @param              $position
     *
     * @return bool
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function hasContainer( AbsCnr $container, $position ) {
        return $this->isProperPosition( $position )
               && in_array( $container->getHashId(), $this->containers[ $position ] );
    }

    /**
     * @return array Of AbsCmp
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    MenuPage::$components
     * @codeCoverageIgnore
     */
    public function getContainers() {
        return $this->containers;
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
     * @since  1.0.0
     */
    public function getTwig() {
        if ( ! $this->hasCacheKey( __METHOD__ ) ) {
            $this->writeCache( __METHOD__, new Twig( $this ) );
        }

        return $this->readCache( __METHOD__ );
    }

    /**
     * @return WpMenuPages
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @see    MenuPage::$wpMenuPages
     * @codeCoverageIgnore
     */
    public function getWpMenuPages() {
        return $this->wpMenuPages;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @see    MenuPage::$capability
     * @codeCoverageIgnore
     */
    public function getCapability() {
        return $this->capability;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    AbsMenuPage::$title
     * @codeCoverageIgnore
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    AbsMenuPage::$subtitle
     * @codeCoverageIgnore
     */
    public function getSubtitle() {
        return $this->subtitle;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    AbsMenuPage::$templateName
     * @codeCoverageIgnore
     */
    public function getTemplateName() {
        return $this->templateName;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    AbsMenuPage::$menuTitle
     * @codeCoverageIgnore
     */
    public function getMenuTitle() {
        return $this->menuTitle;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    AbsMenuPage::$iconUrl
     * @codeCoverageIgnore
     */
    public function getIconUrl() {
        return $this->iconUrl;
    }
}