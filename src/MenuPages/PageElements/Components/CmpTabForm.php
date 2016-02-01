<?php
/**
 * CmpTabForm.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     1.0.0
 * @package   Pan\MenuPages\PageComponents
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\PageElements\Components;

use Pan\MenuPages\PageElements\Components\Abs\AbsCmpFields;
use Pan\MenuPages\PageElements\Components\Trt\TrtTab;
use Pan\MenuPages\PageElements\Containers\CnrTabs;
use Pan\MenuPages\Trt\TrtState;

/**
 * Class CmpTabForm
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     1.0.0
 * @package   Pan\MenuPages\PageComponents
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 *
 * @property CnrTabs $container
 */
class CmpTabForm extends AbsCmpFields {
    use TrtState, TrtTab;

    protected $templateName = 'tabForm.twig';

    public function __construct(
        CnrTabs $container,
        $title,
        $icon = ''
    ) {
        $this->container = $container;
        $this->title     = $title;
        $this->icon   = $icon;
        parent::__construct( $container, CnrTabs::CNR_TAB );
    }

    public function saveState() {
        $this->container->getMenuPage()->setElementState( $this->title, $this->active );
    }
}