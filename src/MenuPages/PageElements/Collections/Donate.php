<?php
/**
 * Donate.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2016-02-15
 * @package   Pan\MenuPages\PageElements\Collections
 */


namespace Pan\MenuPages\PageElements\Collections;

use Pan\MenuPages\Fields\Select;
use Pan\MenuPages\PageElements\Collections\Abs\AbsCln;
use Pan\MenuPages\PageElements\Components\CmpFields;
use Pan\MenuPages\PageElements\Containers\CnrCollapsible;
use Pan\MenuPages\Pages\Abs\AbsMenuPage;

/**
 * Class Donate
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2016-02-15
 * @package   Pan\MenuPages\PageElements\Collections
 */
class Donate extends AbsCln {
    protected function setUp( $options = [ ] ) {
        $defaults = [
            'amount'     => 5,
            'options'    => [
                '$2.00'  => 2,
                '$5.00'  => 5,
                '$10.00' => 10,
                '$20.00' => 20,

            ],
            'selectName' => 'donate',
            'title'      => 'Donate Us',
            'position'   => AbsMenuPage::POSITION_ASIDE,
        ];

        $options = wp_parse_args( $options, $defaults );

        $this->menuPage->getOptions()->addOptions( [ 'donate' => $options['amount'] ] );

        $clp = new CnrCollapsible( $this->menuPage, $options['position'], $options['title'] );
        $cmp = new CmpFields( $clp );

        $select = new Select( $cmp, $options['selectName'] );
        $select->setOptions( $options['options'] );

        $this->items[] = $clp;
    }
}