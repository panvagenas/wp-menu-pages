<?php
/**
 * TextArea.php description
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
 * Class TextArea
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class TextArea extends AbsInput {
    protected $type = 'textarea';
    /**
     * @var int
     */
    protected $rows = 5;
    /**
     * @var int
     */
    protected $cols = 25;

    public function getTemplateName() {
        return 'fields/textarea.twig';
    }

    /**
     * @return int
     * @see    TextArea::$cols
     * @codeCoverageIgnore
     */
    public function getCols() {
        return $this->cols;
    }

    /**
     * @param int $cols
     *
     * @return $this
     * @codeCoverageIgnore
     */
    public function setCols( $cols ) {
        if ( is_int( $cols ) && $cols > 0 ) {
            $this->cols = $cols;
        }

        return $this;
    }

    /**
     * @return int
     * @see    TextArea::$rows
     * @codeCoverageIgnore
     */
    public function getRows() {
        return $this->rows;
    }

    /**
     * @param int $rows
     *
     * @return $this
     * @codeCoverageIgnore
     */
    public function setRows( $rows ) {
        if ( is_int( $rows ) && $rows > 0 ) {
            $this->rows = $rows;
        }

        return $this;
    }
}