<?php
/**
 * PluginInfo.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2016-02-15
 * @package   Pan\MenuPages\PageElements\Collections
 */


namespace Pan\MenuPages\PageElements\Collections;

use Pan\MenuPages\PageElements\Collections\Abs\AbsCln;
use Pan\MenuPages\PageElements\Components\CmpRaw;
use Pan\MenuPages\PageElements\Containers\CnrCollapsible;
use Pan\MenuPages\Pages\Page;

/**
 * Class PluginInfo
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2016-02-15
 * @package   Pan\MenuPages\PageElements\Collections
 */
class PluginInfo extends AbsCln {
    protected function setUp( $options = [ ] ) {
        $defaults = [
            'show' => [
                'Name',
                'Version',
                'Description',
                'Author',
                'TextDomain',
                'DomainPath',
            ],
            'title' => 'Plugin Info',
            'position' => Page::POSITION_ASIDE,
        ];

        add_action('admin_init', function() use ($options, $defaults){
            $options = wp_parse_args( $options, $defaults );

            $clp = new CnrCollapsible( $this->menuPage, $options['position'], $options['title'] );
            $cmp = new CmpRaw( $clp );

            $data = $this->menuPage->getWpMenuPages()->getPluginMetaData();

            if ( empty( $data ) ) {
                return;
            }

            $content = '<ul class="list-group">';
            foreach ( $options['show'] as $infoIndex ) {
                if ( ! isset( $data[ $infoIndex ] ) || empty( $data[ $infoIndex ] ) ) {
                    continue;
                }
                $content .= '<li class="list-group-item">';
                if ( $infoIndex == 'Name' ) {
                    $link = isset( $data['PluginURI'] ) && ! empty( $data['PluginURI'] ) ? $data['PluginURI'] : '#';
                    $content .= 'Name: <a href="' . $link . '" class="" target="_blank">' . $data['Name'] . '</a>';
                } else {
                    $content .= $infoIndex . ': ' . $data[ $infoIndex ];
                }
                $content .= '</li>';
            }
            $content .= '</ul>';

            $cmp->setContent($content);

            $this->items[] = $clp;
        },11);


    }
}