<?php
/**
 * Image.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     1.0.0
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Fields;

/**
 * Class Image
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     1.0.0
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class Image extends File {
    protected $type = 'image';
    /**
     * @var string
     */
    protected $alt;
    /**
     * @var int
     */
    protected $height;
    /**
     * @var int
     */
    protected $width;
    /**
     * @var string
     */
    protected $src;

    /**
     * @return string
     * @see    Image::$alt
     * @codeCoverageIgnore
     */
    public function getAlt() {
        return $this->alt;
    }

    /**
     * @param string $alt
     *
     * @return $this
     * @codeCoverageIgnore
     */
    public function setAlt( $alt ) {
        $this->alt = (string) $alt;

        return $this;
    }

    /**
     * @return int
     * @see    Image::$height
     * @codeCoverageIgnore
     */
    public function getHeight() {
        return $this->height;
    }

    /**
     * @param int $height
     *
     * @return $this
     * @codeCoverageIgnore
     */
    public function setHeight( $height ) {
        $this->height = (int) $height;

        return $this;
    }

    /**
     * @return int
     * @see    Image::$width
     * @codeCoverageIgnore
     */
    public function getWidth() {
        return $this->width;
    }

    /**
     * @param int $width
     *
     * @return $this
     * @codeCoverageIgnore
     */
    public function setWidth( $width ) {
        $this->width = (int) $width;

        return $this;
    }

    /**
     * @return string
     * @see    Image::$src
     * @codeCoverageIgnore
     */
    public function getSrc() {
        return $this->src;
    }

    /**
     * @param string $src
     *
     * @return $this
     * @codeCoverageIgnore
     */
    public function setSrc( $src ) {
        $this->src = (int) $src;

        return $this;
    }
}