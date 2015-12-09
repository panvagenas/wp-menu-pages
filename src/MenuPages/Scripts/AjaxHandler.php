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
use Pan\MenuPages\Fields\Ifc\IfcValidation;
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
        // Check for nonce
        check_ajax_referer( IfcScripts::ACTION_SAVE_PREFIX . $this->menuPage->getMenuSlug(), 'nonce' );

        $this->checkPermisions() or die;

        // Get options from POST
        $newOptions = [ ];
        wp_parse_str( $_POST['options'], $newOptions );

        // Validate options
        $allValid          = true;
        $validationResults = [ ];
        $validValues       = [ ];
        $optionsObj        = $this->menuPage->getOptions();

        $currentOptions = $optionsObj->getOptions();
        $match          = true;
        foreach ( $newOptions as $name => $value ) {
            if ( ! $optionsObj->exists( $name ) ) {
                unset( $newOptions[ $name ] );
                continue;
            }
            if ( $value != $currentOptions[ $name ] ) {
                $match = false;
                continue;
            }
            unset( $newOptions[ $name ] );
        }

        foreach ( $newOptions as $name => $value ) {
            $field = $this->menuPage->getFieldByName( $name );
            if ( $field && $field instanceof IfcValidation ) {
                $validationResults[ $name ] = $field->validate( $value );
                if ( $validationResults[ $name ]['valid'] ) {
                    continue;
                }
                $allValid = false;
            }
            unset( $newOptions[ $name ] );
        }

        $validationResults['saved'] = ( ! empty( $newOptions ) && $optionsObj->setArray( $newOptions ) ) || $match;

        // Send response
        if ( $allValid && $validationResults['saved'] ) {
            wp_send_json_success( $validationResults );

            return;
        }

        wp_send_json_error( $validationResults );
    }

    public function resetOptions() {
        check_ajax_referer( IfcScripts::ACTION_RESET_PREFIX . $this->menuPage->getMenuSlug(), 'nonce' );

        $this->checkPermisions() or die;

        $include = [ ];
        if ( isset( $_POST['include'] ) ) {
            wp_parse_str( $_POST['include'], $include );
        }

        $result = [ ];

        $options = $this->menuPage->getOptions();

        $result['defaults'] = $options->getDefaults();

        if ( empty( $include ) ) {
            $include = $result['defaults'];
        }

        $result['defaults'] = array_intersect_key( $result['defaults'], $include );

        $currentOptions = array_intersect_key( $options->getOptions(), $include );

        $match = true;
        foreach ( $currentOptions as $name => $value ) {
            if ( $value != $result['defaults'][ $name ] ) {
                $match = false;
            }
        }

        $result['reset'] = $options->setArray( $result['defaults'] );

        if ( $result['reset'] || $match ) {
            wp_send_json_success( $result );

            return;
        }

        wp_send_json_error( $result );
    }

    public function updateCoreOptions(){
        check_ajax_referer( IfcScripts::ACTION_UPDATE_CORE_OPTIONS_PREFIX . $this->menuPage->getMenuSlug(), 'nonce' );
        $this->checkPermisions() or die;

        $newOptions = (array)$_POST['options'];

        foreach ( $newOptions as $name => $value ) {
            $this->menuPage->setPageOption($name, $value);
        }

        wp_send_json_success();
    }

    public function exportOptions() {
        check_ajax_referer( IfcScripts::ACTION_EXPORT_PREFIX . $this->menuPage->getMenuSlug(), 'nonce' );
        $this->checkPermisions() or die;
    }

    public function importOptions() {
        check_ajax_referer( IfcScripts::ACTION_IMPORT_PREFIX . $this->menuPage->getMenuSlug(), 'nonce' );
        $this->checkPermisions() or die;
    }

    protected function checkPermisions() {
        return current_user_can( $this->menuPage->getCapability() );
    }
}