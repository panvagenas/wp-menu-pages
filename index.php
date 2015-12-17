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

require_once 'vendor/autoload.php';

$defaultOptions = [
    'text_demo' => 'This is a text field'
];

$optionsObj = \Pan\MenuPages\Options::getInstance('wp_menu_pages_demo', $defaultOptions);

$wpMenuPages = new \Pan\MenuPages\WpMenuPages(__FILE__, $optionsObj);

$mainPage = new \Pan\MenuPages\Pages\Page($wpMenuPages, 'My Settings');
$subPage = new \Pan\MenuPages\Pages\SubPage($wpMenuPages, $mainPage, 'Sub Page Demo');

$tabTextFieldsDemo = new \Pan\MenuPages\PageComponents\Tab($mainPage, 'Text Fields', true);
$tabSelectFieldsDemo = new \Pan\MenuPages\PageComponents\Tab($mainPage,'Select Fields');
$tabRadioFieldsDemo = new \Pan\MenuPages\PageComponents\Tab($mainPage, 'Radio Fields');

$tabNumberFieldsDemo = new \Pan\MenuPages\PageComponents\Tab($subPage, 'Number Fields');
$tabWpSpecificDemo = new \Pan\MenuPages\PageComponents\Tab($subPage, 'WordPress');