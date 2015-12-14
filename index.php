<?php
/*
Plugin Name: Wp Mn Pg
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: vagenas
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/

ini_set( 'display_errors', E_ALL );

require_once 'wp-menu-pages/vendor/autoload.php';

$defaults = [
    // File location
    'xml_location'                               => '',
    // File name
    'xml_fileName'                               => 'skroutz.xml',
    // Generation interval
    'xml_interval'                               => 12,
    // XML Generate Request Var
    'xml_generate_var'                           => 'skroutz',
    // XML Generate Request Var Value
    'xml_generate_var_value'                     => uniqid('ddw', true).uniqid('oow', true),
    // advanced options
    'show_advanced'                              => 0,
    /*********************
     * Products relative
     ********************/
    // Include products
    'products_include'                           => array( 'product' ),
    // Availability when products in stock
    'avail_inStock'                              => 1,
    // Availability when products out stock
    'avail_outOfStock'                           => 5,
    // Availability when products out stock and backorders are allowed
    'avail_backorders'                           => 5,
    /*********************
     * Custom fields
     ********************/
    'map_id'                                     => 1,
    'map_name'                                   => 2,
    'map_name_append_sku'                        => 1,
    'map_link'                                   => 0,
    'map_image'                                  => 3,
    'map_category'                               => 'product',
    'map_category_tree'                          => 0,
    'map_price_with_vat'                         => 1,
    'map_manufacturer'                           => 0,
    'map_mpn'                                    => 0,
    'map_size'                                   => array(2,1),
    'map_size_use'                               => 0,
    'map_color'                                  => array(),
    'map_color_use'                              => 0,
    /***********************************************
     * Fashion store
     ***********************************************/
    'is_fashion_store'                           => 0,
    /***********************************************
     * ISBN
     ***********************************************/
    'map_isbn'                                   => 0,
    'is_book_store'                              => 0,
];

$productAttributesOptions = [
    'Attr 1'    => 1,
    'Attr 2'    => 2,
    'Attr 3'    => 3,
];

$xml_interval_options = [
    'Daily' => 24,
    'Twice Daily' => 12,
    'Hourly' => 1,
];

$availability = [
    'Available' => 1,
    '1-3 days' => 2,
    '4-7 days' => 3,
    'Preorder' => 4,
];

$availabilityDoNotInclude = array_merge($availability, ['Do Not Include' => 5]);

$options = \Pan\MenuPages\Options::getInstance( 'skz', $defaults );

$wpMenuPages = new \Pan\MenuPages\WpMenuPages( __FILE__, $options, '', 'wp-menu-pages' );

$menuPage = new \Pan\MenuPages\MenuPage( $wpMenuPages, 'WP Menu Pages Settings', 'My Settings', 'wp-menu-pages' );

$mainOptionsTab = new \Pan\MenuPages\PageComponents\Tab( $menuPage, 'General Options', true );
$advOptionsTab = new \Pan\MenuPages\PageComponents\Tab( $menuPage, 'Advanced Options' );
$mapOptionsTab = new \Pan\MenuPages\PageComponents\Tab( $menuPage, 'Map Options' );

$xml_location = new \Pan\MenuPages\Fields\Text($mainOptionsTab, 'xml_location');
$xml_fileName = new \Pan\MenuPages\Fields\Text($mainOptionsTab, 'xml_fileName');
$xml_interval = new \Pan\MenuPages\Fields\Number($mainOptionsTab, 'xml_interval');
$xml_generate_var = new \Pan\MenuPages\Fields\Text($advOptionsTab, 'xml_generate_var');
$xml_generate_var_value = new \Pan\MenuPages\Fields\Text($advOptionsTab, 'xml_generate_var_value');
$avail_inStock = new \Pan\MenuPages\Fields\Select($mainOptionsTab, 'avail_inStock');
$avail_outOfStock = new \Pan\MenuPages\Fields\Select($mainOptionsTab, 'avail_outOfStock');
$avail_backorders = new \Pan\MenuPages\Fields\Select($mainOptionsTab, 'avail_backorders');

$map_id = new \Pan\MenuPages\Fields\Select($mapOptionsTab, 'map_id');
$map_name = new \Pan\MenuPages\Fields\Select($mapOptionsTab, 'map_name');
$map_name_append_sku = new \Pan\MenuPages\Fields\SwitchField($mapOptionsTab, 'map_name_append_sku');

$is_fashion_store = new \Pan\MenuPages\Fields\SwitchField($mapOptionsTab, 'is_fashion_store');
$map_size = new \Pan\MenuPages\Fields\MultiSelect($mapOptionsTab, 'map_size');

$xml_location->setLabel('XML Location');
$xml_fileName->setLabel('XML Filename');
$xml_interval->setMin(1)->setMax(24)->setStep(1)->setLabel('XML Generation Interval');

$avail_inStock->setLabel('Availability in stock')->setOptions($availability);
$avail_outOfStock->setLabel('Availability Out of Stock')->setOptions($availabilityDoNotInclude);
$avail_backorders->setLabel('Availability Backorders')->setOptions($availabilityDoNotInclude);

$xml_generate_var->setLabel('XML Generate Var Name');
$xml_generate_var_value->setLabel('XML Generate Var Value');

$map_id->setLabel('Map Product ID')->setOptions($productAttributesOptions);
$map_name->setLabel('Map Product Name')->setOptions($productAttributesOptions);
$map_name_append_sku->setLabel('Append SKU to Product Name?');

$is_fashion_store->setLabel('This Store Contains Fashio Products');

$map_size->setLabel('Map Product Size')->setOptions($productAttributesOptions);