<?php
/**
 * Alert.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\PageComponents
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\PageElements\Components;

use Pan\MenuPages\PageElements\Components\Abs\AbsComponent;

/**
 * Class Alert
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\PageComponents
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class Alert extends AbsComponent {
    const TYPE_SUCCESS = 'success';

    const TYPE_INFO = 'info';

    const TYPE_WARNING = 'warning';

    const TYPE_DANGER = 'danger';

    protected $type = self::TYPE_INFO;
    protected $dismissible = true;
    protected $content = '';

    protected $templateName = 'alert.twig';

    /**
     * @return string
     * @since     TODO ${VERSION}
     * @package   Pan\MenuPages\PageComponents
     * @copyright Copyright (c) 2015 Panagiotis Vagenas
     * @see       Alert::$type
     * @codeCoverageIgnore
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @since     TODO ${VERSION}
     * @package   Pan\MenuPages\PageComponents
     * @copyright Copyright (c) 2015 Panagiotis Vagenas
     * @see       Alert::$type
     */
    public function setType( $type ) {
        $this->type = $type;
    }

    /**
     * @return boolean
     * @since     TODO ${VERSION}
     * @package   Pan\MenuPages\PageComponents
     * @copyright Copyright (c) 2015 Panagiotis Vagenas
     * @see       Alert::$dismissible
     * @codeCoverageIgnore
     */
    public function isDismissible() {
        return $this->dismissible;
    }

    /**
     * @param boolean $dismissible
     *
     * @since     TODO ${VERSION}
     * @package   Pan\MenuPages\PageComponents
     * @copyright Copyright (c) 2015 Panagiotis Vagenas
     * @see       Alert::$dismissible
     */
    public function setDismissible( $dismissible ) {
        $this->dismissible = $dismissible;
    }

    /**
     * @return string
     * @since     TODO ${VERSION}
     * @package   Pan\MenuPages\PageComponents
     * @copyright Copyright (c) 2015 Panagiotis Vagenas
     * @see       Alert::$content
     * @codeCoverageIgnore
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @since     TODO ${VERSION}
     * @package   Pan\MenuPages\PageComponents
     * @copyright Copyright (c) 2015 Panagiotis Vagenas
     * @see       Alert::$content
     */
    public function setContent( $content ) {
        $this->content = $content;
    }

}