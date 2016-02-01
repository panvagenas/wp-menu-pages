<?php
/**
 * TrtValidation.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     1.0.0
 * @package   Pan\MenuPages\Fields\Traits
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */


namespace Pan\MenuPages\Fields\Trt;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator;

/**
 * Class TrtValidation
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      ${YEAR}-${MONTH}-${DAY}
 * @since     1.0.0
 * @package   Pan\MenuPages\Fields\Trt
 * @copyright Copyright (c) ${YEAR} Panagiotis Vagenas
 */
trait TrtValidation {
    /**
     * @var array
     */
    protected $validators = [ ];

    /**
     * @param        $value
     * @param string $fieldName
     *
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function isValid( $value, $fieldName = '' ) {
        $valid  = true;
        $errors = array();

        foreach ( $this->validators as $validator ) {
            /* @var Validator $validator */
            if ( $fieldName ) {
                $validator->setName( '"' . $fieldName . '"' );
            }

            try {
                $validator->check( $value );
            } catch ( ValidationException $exception ) {
                $errors[] = $exception->getMainMessage();
                $valid    = false;
            }
        }

        $ret = compact( 'value', 'valid', 'errors' );

        return $ret;
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    Validation::$validators
     * @codeCoverageIgnore
     */
    public function getValidators() {
        return $this->validators;
    }

    /**
     * @param Validator $validator
     * @param           $key
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function attachValidator( Validator $validator, $key = '' ) {
        if ( $key ) {
            $this->validators[ $key ] = $validator;

            return $this;
        }

        $this->validators[ spl_object_hash( $validator ) ] = $validator;

        return $this;
    }
}