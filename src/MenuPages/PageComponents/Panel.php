<?php
/**
 * Panel.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\PageComponents
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\PageComponents;

use Pan\MenuPages\PageComponents\Abs\AbsMenuPageFieldsComponent;
use Pan\MenuPages\Pages\Abs\AbsMenuPage;

/**
 * Class Panel
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\PageComponents
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class Panel extends AbsMenuPageFieldsComponent {
    protected $title;

    public function __construct( Aside $aside, $title ) {
        parent::__construct( $aside->getMenuPage() );
        $aside->addPanel($this);
        $this->title = $title;
        $this->form->setClass('');
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle( $title ) {
        $this->title = $title;

        return $this;
    }
}