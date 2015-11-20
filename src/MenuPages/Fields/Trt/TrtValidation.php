<?php
/**
 * TrtValidation.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-20
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields\Traits
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */


namespace Pan\MenuPages\Fields\Trt;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator;

trait TrtValidation {
    protected $validators = [ ];

    public function isValid( $value ) {
        $valid  = true;
        $errors = array();

        foreach ( $this->validators as $validator ) {
            /* @var Validator $validator */
            try {
                $validator->check( $value );
            } catch ( ValidationException $exception ) {
                $errors[] = $exception->getMainMessage();
                $valid    = false;
            }
        }

        return compact( $value, $valid, $errors );
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

    public function attachValidator( Validator $validator ) {
        $this->validators[] = $validator;

        return $this;
    }
}