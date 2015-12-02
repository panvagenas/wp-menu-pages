<?php
/**
 * File.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Fields;

use Pan\MenuPages\Fields\Abs\AbsInput;

/**
 * Class File
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class File extends AbsInput {
    protected $type = 'file';
    /**
     * @var string
     */
    protected $accept;

    /**
     * @return string
     * @see    File::$accept
     * @codeCoverageIgnore
     */
    public function getAccept() {
        return $this->accept;
    }

    /**
     * @param string $accept
     *
     * @return $this
     * @codeCoverageIgnore
     */
    public function setAccept( $accept ) {
        $this->accept = (string) $accept;

        return $this;
    }
}