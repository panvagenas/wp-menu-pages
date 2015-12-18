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
    'text' => 'This is a text field',
    'color' => '#ffaa33',
    'date' => date('Y-m-d'),
    'dateTime' => date('Y-m-dTH:i:s'),
    'dateTimeLocal' => date('Y-m-dTH:i:s'),
    'email' => 'my.mail@example.com',
    'hidden' => '',
    'image' => '',
    'month' => '10',
    'multiSelect' => [],
    'number' => 7,
    'password' => '',
    'postType' => '',
    'postTypeMultiple' => [],
    'radio' => '',
    'range' => '',
    'search' => '',
    'select' => '',
    'select2' => '',
    'select2multiple' => [],
    'switch' => 1,
    'taxonomies' => '',
    'taxonomiesMultiple' => [],
    'tel' => '',
    'textArea' => '',
    'time' => date('H:i:s'),
    'url' => '',
    'week' => 25,
];

$selectOptions = [
    'Option 1' => 1,
    'Option 2' => 2,
    'Option 3' => 3,
    'Option 4' => 4,
    'Option 5' => 5,
    'Option 6' => 6,
];

$radioOptions = [
    'Option 1' => 1,
    'Option 2' => 2,
    'Option 3' => 3,
    'Option 4' => 4,
];

$selectOptionGroups = [
    'Option 1' => 1,
    'Option 2' => 2,
    'Group 1' => [
        'Group 1 Option 1' => 11,
        'Group 1 Option 2' => 12,
        'Group 1 Option 3' => 13,
        'Group 1 Option 4' => 14,
        'Group 1 Option 5' => 15,
        'Group 1 Option 6' => 16,
    ],
    'Option 3' => 3,
    'Option 4' => 4,
    'Group 2' => [
        'Group 2 Option 1' => 21,
        'Group 2 Option 2' => 22,
        'Group 2 Option 3' => 23,
        'Group 2 Option 4' => 24,
        'Group 2 Option 5' => 25,
        'Group 2 Option 6' => 26,
    ],
    'Option 5' => 5,
    'Option 6' => 6,
];

$optionsObj = \Pan\MenuPages\Options::getInstance('wp_menu_pages_demo', $defaultOptions);

$wpMenuPages = new \Pan\MenuPages\WpMenuPages(__FILE__, $optionsObj);

$mainPage = new \Pan\MenuPages\Pages\Page($wpMenuPages, 'My Settings');
$subPage = new \Pan\MenuPages\Pages\SubPage($wpMenuPages, $mainPage, 'Sub Page Demo');

$tabsMainPage = new \Pan\MenuPages\PageElements\Containers\Tabs(
    $mainPage,
    \Pan\MenuPages\PageElements\Containers\Tabs::POSITION_MAIN
);


$tabTextFields = new \Pan\MenuPages\PageElements\Containers\Tab($tabsMainPage, 'Text Fields', true);
$tabDateTimeFields = new \Pan\MenuPages\PageElements\Containers\Tab($tabsMainPage, 'Date-Time Fields');
$tabSelectFields = new \Pan\MenuPages\PageElements\Containers\Tab($tabsMainPage,'Select Fields');
$tabRadioFields  = new \Pan\MenuPages\PageElements\Containers\Tab($tabsMainPage, 'Radio Fields');
$tabMediaFields  = new \Pan\MenuPages\PageElements\Containers\Tab($tabsMainPage, 'Media Fields');
$tabOtherFields  = new \Pan\MenuPages\PageElements\Containers\Tab($tabsMainPage, 'Other Fields');

$tabNumberFieldsDemo = new \Pan\MenuPages\PageElements\Containers\Tab($tabsMainPage, 'Number Fields');
$tabWpSpecificDemo = new \Pan\MenuPages\PageElements\Containers\Tab($tabsMainPage, 'WordPress');

$formTextFields = new \Pan\MenuPages\PageElements\Components\Form($tabTextFields);

$color = new \Pan\MenuPages\Fields\Color($formTextFields, 'color');
$color->setLabel('Color Demo');

$date = new \Pan\MenuPages\Fields\Date($formTextFields, 'date');
$date->setLabel('Date Demo');

$dateTime = new \Pan\MenuPages\Fields\DateTime($formTextFields, 'dateTime');
$dateTime->setLabel('Date Time Demo');

$dateTimeLocal = new \Pan\MenuPages\Fields\DateTimeLocal($formTextFields, 'dateTimeLocal');
$dateTimeLocal->setLabel('Date Time Local Demo');

$email = new \Pan\MenuPages\Fields\Email($formTextFields, 'email');
$email->setLabel('Email Demo');

$hidden = new \Pan\MenuPages\Fields\Hidden($formTextFields, 'hidden');
$hidden->setLabel('Hidden Field Demo');

//$image = new \Pan\MenuPages\Fields\Image($tabMediaFields, 'image');
//$image->setLabel('Image Demo');
//
//$month = new \Pan\MenuPages\Fields\Month($tabDateTimeFields, 'month');
//$month->setLabel('Month Demo');
//
//$multiSelect = new \Pan\MenuPages\Fields\MultiSelect($tabSelectFields, 'multiSelect');
//$multiSelect->setLabel('Multi Select Demo')->setOptions($selectOptionGroups);
//
//$number = new \Pan\MenuPages\Fields\Number($tabNumberFieldsDemo, 'number');
//$number->setLabel('Number Demo');
//
//$password = new \Pan\MenuPages\Fields\Password($tabTextFields, 'password');
//$password->setLabel('Password Demo');
//
//$postType = new \Pan\MenuPages\Fields\PostType($tabWpSpecificDemo, 'postType');
//$postType->setLabel('Post Type Demo');
//
//$postTypeMultiple = new \Pan\MenuPages\Fields\PostType($tabWpSpecificDemo, 'postTypeMultiple');
//$postTypeMultiple->setLabel('Post Type Multiple Demo')->setMultiple(true);
//
//$radio = new \Pan\MenuPages\Fields\Radio($tabRadioFields, 'radio');
//$radio->setLabel('Radio Demo')->setOptions($radioOptions);
//
//$range = new \Pan\MenuPages\Fields\Range($tabNumberFieldsDemo, 'range');
//$range->setLabel('Range Demo');
//
//$search = new \Pan\MenuPages\Fields\Search($tabTextFields, 'search');
//$search->setLabel('Search Demo');
//
//$select = new \Pan\MenuPages\Fields\Select($tabSelectFields, 'select');
//$select->setLabel('Select Demo')->setOptions($selectOptions);
//
//$select2 = new \Pan\MenuPages\Fields\Select2($tabSelectFields, 'select2');
//$select2->setLabel('Select2 Demo')->setOptions($selectOptions);
//
//$select2multiple = new \Pan\MenuPages\Fields\Select2($tabSelectFields, 'select2multiple');
//$select2multiple->setLabel('Select2 Multiple Demo')->setOptions($selectOptionGroups)->setMultiple(true);
//
//$switch = new \Pan\MenuPages\Fields\SwitchField($tabRadioFields, 'switch');
//$switch->setLabel('Switch Demo');
//
//$taxonomies = new \Pan\MenuPages\Fields\Taxonomies($tabWpSpecificDemo, 'taxonomies');
//$taxonomies->setLabel('Taxonomies Demo');
//
//$taxonomiesMultiple = new \Pan\MenuPages\Fields\Taxonomies($tabWpSpecificDemo, 'taxonomiesMultiple');
//$taxonomiesMultiple->setLabel('Taxonomies Multiple Demo')->setMultiple(true);
//
//$tel = new \Pan\MenuPages\Fields\Tel($tabTextFields, 'tel');
//$tel->setLabel('Tel Demo');
//
//$text = new \Pan\MenuPages\Fields\Text($tabTextFields, 'text');
//$text->setLabel('Text Demo');
//
//$textArea = new \Pan\MenuPages\Fields\TextArea($tabTextFields, 'textArea');
//$textArea->setLabel('Text Area Demo');
//
//$time = new \Pan\MenuPages\Fields\Time($tabDateTimeFields, 'time');
//$time->setLabel('Time Demo');
//
//$url = new \Pan\MenuPages\Fields\Url($tabTextFields, 'url');
//$url->setLabel('Url Demo');
//
//$week = new \Pan\MenuPages\Fields\Week($tabDateTimeFields, 'week');
//$week->setLabel('Week Demo');
//
//$raw = new \Pan\MenuPages\Fields\Raw($tabOtherFields, 'raw');
//$content = '<div class="jumbotron"><h1>Html allowed in <code>Raw</code> fields!</h1>
//<p>Sunt quadraes manifestum peritus, clemens compateres. Capio noster ventus est.Pol, diatria!
//Clinias, verpa, et adgium.</p>
//</div>';
//$raw->setContent($content);
//
//$divider = new \Pan\MenuPages\Fields\Divider($tabOtherFields);
//
//$panel = new \Pan\MenuPages\PageElements\Containers\Collapsible($aside, 'Collapsible Demo');
//
//(new \Pan\MenuPages\Fields\Raw($panel))->setContent($content);