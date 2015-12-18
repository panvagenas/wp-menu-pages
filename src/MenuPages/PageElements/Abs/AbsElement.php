<?php

namespace Pan\MenuPages\PageElements\Abs;

use Pan\MenuPages\Pages\Abs\AbsMenuPage;
use Pan\MenuPages\Trt\TrtIdentifiable;

class AbsElement {
    use TrtIdentifiable;

    /**
     * @var \Pan\MenuPages\Pages\Abs\AbsMenuPage
     */
    protected $menuPage;

    public function __construct( AbsMenuPage $menuPage ) {
        $this->menuPage = $menuPage;
        $this->menuPage->attachElement( $this );
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

    public function getOptions() {
        return $this->menuPage->getOptions();
    }
}