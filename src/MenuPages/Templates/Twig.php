<?php
/**
 * Twig.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     1.0.0
 * @package   Pan\MenuPages\Templates
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Templates;

use Pan\MenuPages\Pages\Abs\AbsMenuPage;
use Pan\MenuPages\Templates\Ifc\IfcTemplateConstants;


/**
 * Class Twig
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     1.0.0
 * @package   Pan\MenuPages\Templates
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class Twig {
    /**
     * @var \Twig_Environment
     */
    protected $twigEnvironment;
    /**
     * @var \Twig_Loader_Filesystem
     */
    protected $twigLoader;
    /**
     * @var string
     */
    protected $defaultPaths = [ ];
    /**
     * @var string
     */
    protected $cachePath;

    /**
     * Twig constructor.
     *
     * @param AbsMenuPage $menuPage
     *
     * @since  1.0.0
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     */
    public function __construct( AbsMenuPage $menuPage ) {
        $basePath = $menuPage->getWpMenuPages()->getBasePath();

        $this->defaultPaths[] = $basePath . '/' . IfcTemplateConstants::TEMPLATES_DIR;
        $this->cachePath      = $basePath . '/cache';

        $this->twigLoader = new \Twig_Loader_Filesystem( $this->defaultPaths );

        $this->twigEnvironment = new \Twig_Environment( $this->twigLoader );
        $this->twigEnvironment->addExtension( new \Twig_Extension_Debug() );
        $this->twigEnvironment->addExtension( new WpTwigExtension( $menuPage ) );

    }

    /**
     * @return \Twig_Environment
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    Twig::$twigEnvironment
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getTwigEnvironment() {
        return $this->twigEnvironment;
    }

    /**
     * @return \Twig_Loader_Filesystem
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    Twig::$twigLoader
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getTwigLoader() {
        return $this->twigLoader;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    Twig::$defaultPaths
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getDefaultPaths() {
        return $this->defaultPaths;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    Twig::$cachePath
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getCachePath() {
        return $this->cachePath;
    }
}