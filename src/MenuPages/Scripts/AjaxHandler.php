<?php
/**
 * AjaxHandler.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-12-04
 * @package   Pan\MenuPages\Scripts
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */


namespace Pan\MenuPages\Scripts;

use Pan\MenuPages\Abs\AbsSingleton;
use Pan\MenuPages\Fields\Abs\AbsInputBase;
use Pan\MenuPages\Fields\Trt\TrtValidation;
use Pan\MenuPages\Scripts\Ifc\IfcScripts;

/**
 * Class AjaxHandler
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-12-04
 * @package   Pan\MenuPages\Scripts
 * @since     TODO ${VERSION}
 */
class AjaxHandler extends AbsSingleton {
    public function saveOptions() {
        // TODO Implement
        // Check for nonce
        // TODO check_ajax_referer();
        check_ajax_referer(IfcScripts::ACTION_SAVE_PREFIX.$this->menuPage->getMenuSlug(), 'nonce');

        // Get options from POST
        $newOptions = [ ];
        wp_parse_str( $_POST['options'], $newOptions );

        // Validate options
        $allValid          = true;
        $validationResults = [ ];
        $validValues       = [ ];
        $optionsObj        = $this->menuPage->getOptions();

        foreach ( $newOptions as $name => $value ) {
            $field = $this->menuPage->getFieldByName( $name );
            if ( $field && $field instanceof AbsInputBase ) {
                $validationResults[ $name ] = $field->validate( $value );
                if ( $validationResults[ $name ]['valid'] ) {
                    $optionsObj->set( $name, $value );
                } else {
                    $allValid = false;
                }
            }
        }

        // Send response
        if ( $allValid ) {
            wp_send_json_success( $validationResults );
            return;
        }

        wp_send_json_error( $validationResults);
    }

    public function resetOptions() {
    }

    public function exportOptions() {
    }

    public function importOptions() {
    }
}