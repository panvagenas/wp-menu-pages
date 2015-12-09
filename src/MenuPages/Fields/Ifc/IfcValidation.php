<?php

namespace Pan\MenuPages\Fields\Ifc;

interface IfcValidation {
    /**
     * Should return a validation result array as in {@link \Pan\MenuPages\Fields\Trt\TrtValidation::isValid()}
     * ```
     * [
     *      'value' => $value,
     *      'valid' => $valid,
     *      'errors' => $errors,
     * ]
     *
     * @param mixed $value
     *
     * @return array
     * <pre>
     * [
     *     'valid' => bool $valid,
     *     'value' => mixed $value,
     *     'errors' => [string $errorMsg1, string $errorMsg2, ...]
     * ]
     * </pre>
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function validate( $value );
}