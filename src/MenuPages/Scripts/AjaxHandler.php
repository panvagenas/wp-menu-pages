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
use Pan\MenuPages\Ifc\IfcConstants;
use Pan\MenuPages\MenuPage;
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
    /**
     * AjaxHandler constructor.
     *
     * @param MenuPage $menuPage
     *
     * @author Panagiotis Vagenas <Panagiotis.Vagenas@interactivedata.com>
     */
    protected function __construct( MenuPage $menuPage ) {
        parent::__construct( $menuPage );
    }

    protected function hidePhpErrors() {
        ini_set( 'display_errors', false );
    }

    public function saveOptions() {
        // Check for nonce
        check_ajax_referer( IfcScripts::ACTION_SAVE_PREFIX . $this->menuPage->getMenuSlug(), 'nonce' );

        $this->checkPermissions() or die;

        $this->hidePhpErrors();

        $newOptions = $this->mayeParseOptions( $_POST['options'] );

        list( $newOptions, $validationResults, $allValid, $match ) = $this->validateOptions( $newOptions );

        $optionsObj = $this->menuPage->getOptions();

        $saved  = ( ! empty( $newOptions ) && $optionsObj->setArray( $newOptions ) ) || $match;
        $return = [ 'options' => $validationResults, 'saved' => $saved ];

        // Send response
        if ( $allValid && $saved ) {
            wp_send_json_success( $return );

            return;
        }

        wp_send_json_error( $return );
    }

    public function resetOptions() {
        check_ajax_referer( IfcScripts::ACTION_RESET_PREFIX . $this->menuPage->getMenuSlug(), 'nonce' );

        $this->checkPermissions() or die;

        $this->hidePhpErrors();

        $include = $this->mayeParseOptions($_POST['include']);

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

    public function updateCoreOptions() {
        check_ajax_referer( IfcScripts::ACTION_UPDATE_CORE_OPTIONS_PREFIX . $this->menuPage->getMenuSlug(), 'nonce' );
        $this->checkPermissions() or die;

        $this->hidePhpErrors();

        $newOptions = (array) $_POST['options'];

        foreach ( $newOptions as $name => $value ) {
            if($this->menuPage->isValidOption($name, $value)) {
                $this->menuPage->setPageOption( $name, $value );
            }
        }

        wp_send_json_success();
    }

    public function exportOptions() {
        check_ajax_referer( IfcScripts::ACTION_EXPORT_PREFIX . $this->menuPage->getMenuSlug(), 'nonce' );
        $this->checkPermissions() or die;
        $this->hidePhpErrors();

        $options = $this->menuPage->getOptions()->getOptions();
        unset( $options[ IfcConstants::CORE_OPTIONS_KEY ] );

        $response = [
            'options' => json_encode( $options ),
            'name'    => basename( $this->menuPage->getOptions()->getOptionsBaseName() ),
        ];
        wp_send_json_success( $response );
    }

    public function importOptions() {
        check_ajax_referer( IfcScripts::ACTION_IMPORT_PREFIX . $this->menuPage->getMenuSlug(), 'nonce' );
        $this->checkPermissions() or die;
        $this->hidePhpErrors();

        $newOptions = $this->mayeParseOptions( $_POST['options'] );

        list( $newOptions, $validationResults, $allValid, $match ) = $this->validateOptions( $newOptions );

        $optionsObj = $this->menuPage->getOptions();

        $saved  = ( ! empty( $newOptions ) && $optionsObj->setArray( $newOptions ) ) || $match;
        $return = [ 'validationResults' => $validationResults, 'saved' => $saved, 'options' => $newOptions ];

        // Send response
        if ( $allValid && $saved ) {
            wp_send_json_success( $return );

            return;
        }

        wp_send_json_error( $return );
    }

    protected function mayeParseOptions( $options ) {
        if ( is_array( $options ) ) {
            return $options;
        }

        $return = [ ];
        if ( is_string( $options ) ) {
            wp_parse_str( $options, $return );
        }

        return $return;
    }

    protected function validateOptions( $newOptions ) {
        $allValid       = true;
        $optionsObj     = $this->menuPage->getOptions();
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
            $validationResults[ $name ]['valid'] = true;
            $validationResults[ $name ]['value'] = $newOptions[ $name ];

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

        return [$newOptions, $validationResults, $allValid, $match];
    }

    protected function checkPermissions() {
        return current_user_can( $this->menuPage->getCapability() );
    }
}