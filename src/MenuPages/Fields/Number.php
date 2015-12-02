<?php
/**
 * Number.php description
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
 * Class Tel
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class Number extends AbsInput {
    protected $type = 'number';
    /**
     * @var int
     */
    protected $min;
    /**
     * @var int
     */
    protected $max;
    /**
     * @var float|int
     */
    protected $step;

    /**
     * @return int
     * @see    Number::$min
     * @codeCoverageIgnore
     */
    public function getMin() {
        return $this->min;
    }

    /**
     * @param int $min
     *
     * @return $this
     * @codeCoverageIgnore
     */
    public function setMin( $min ) {
        $this->min = (int) $min;

        return $this;
    }

    /**
     * @return int
     * @see    Number::$max
     * @codeCoverageIgnore
     */
    public function getMax() {
        return $this->max;
    }

    /**
     * @param int $max
     *
     * @return $this
     * @codeCoverageIgnore
     */
    public function setMax( $max ) {
        $this->max = (int) $max;

        return $this;
    }

    /**
     * @return float|int
     * @see    Number::$step
     * @codeCoverageIgnore
     */
    public function getStep() {
        return $this->step;
    }

    /**
     * @param float|int $step
     *
     * @return $this
     * @codeCoverageIgnore
     */
    public function setStep( $step ) {
        $this->step = is_int( $step ) ? (int) $step : (float) $step;

        return $this;
    }
}