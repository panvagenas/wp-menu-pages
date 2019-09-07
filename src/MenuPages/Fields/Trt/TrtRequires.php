<?php
/**
 * TrtRequires.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2016-02-25
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields\Trt
 * @copyright Copyright (c) 2016 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Fields\Trt;

use Pan\MenuPages\Fields\Ifc\IfcRequirement;

/**
 * Trait TrtRequires
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2016-02-25
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields\Trt
 * @copyright Copyright (c) 2016 Panagiotis Vagenas.
 */
trait TrtRequires {
    protected $requirements = [];
    protected $operators
        = [
            '=',
            '!=',
            '>=',
            '<=',
            '>',
            '<',
            'IN',
            'NOT IN',
            'LIKE',
            'NOT LIKE',
            'BETWEEN',
            'NOT BETWEEN',
            'REGEXP',
        ];

    public function addRequirement( IfcRequirement $requirement, $values, $operator = '=' ) {
        if ( !$this->isValidOperatorForValue( $values, $operator ) ) {
            throw new \InvalidArgumentException( 'Invalid operator' );
        }

        if ( $this->hasRequirement( $requirement ) ) {
            user_error( 'Requirement already defined' );

            return false;
        }

        $this->requirements[] = [
            'r' => $requirement,
            'v' => (array)$values,
            'o' => (string)$operator,
        ];

        return true;
    }

    protected function isValidOperatorForValue( $value, $operator ) {
        // TODO Implement
        return true;
    }

    public function areRequirementsFulfilled() {
        if ( !empty( $this->requirements ) ) {
            foreach ( $this->requirements as $requirement ) {
                // TODO Implement
            }
        }

        return true;
    }

    protected function isRequirementFulfilled( array $requirement ) {
        if ( array_diff_key( ['r' => 1, 'v' => 1, 'o' => 1,], $requirement ) ) {
            user_error( 'Invalid requirement' );

            return false;
        }

        // TODO Implement
        return true;
    }

    public function hasRequirement( IfcRequirement $requirement ) {
        // TODO Implement
        return false;
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    TrtRequires::$requirements
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getRequirements() {
        return $this->requirements;
    }
}