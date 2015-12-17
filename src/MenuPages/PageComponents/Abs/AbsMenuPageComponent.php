<?php

namespace Pan\MenuPages\PageComponents\Abs;

use Pan\MenuPages\Pages\Abs\AbsMenuPage;
use Pan\MenuPages\Templates\Twig;
use Pan\MenuPages\Trt\TrtIdentifiable;

abstract class AbsMenuPageComponent {
    use TrtIdentifiable;
    /**
     * @var \Pan\MenuPages\Pages\Abs\AbsMenuPage
     */
    protected $menuPage;
    /**
     * @var string
     */
    protected $id;

    public function __construct( AbsMenuPage $menuPage ) {
        $this->id       = str_replace( '\\', '__', get_class( $this ) . '-' . $this->getHashId() );
        $this->menuPage = $menuPage;
        $this->menuPage->attachComponent( $this );
    }

    public function getOptions() {
        return $this->menuPage->getOptions();
    }

    /**
     * @return Twig
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getTwig() {
        return $this->menuPage->getTwig();
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @see    AbsMenuPageComponent::$id
     * @codeCoverageIgnore
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return AbsMenuPage
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @see    AbsMenuPageComponent::$menuPage
     * @codeCoverageIgnore
     */
    public function getMenuPage() {
        return $this->menuPage;
    }

}