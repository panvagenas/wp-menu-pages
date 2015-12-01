<?php
ini_set( 'display_errors', 1 );

function get_option( $n, $d ) {
    return $d;
}

if ( isset( $_POST['submit'] ) ) {
    var_dump( $_POST );
}

require_once 'vendor/autoload.php';

$defaults = [
    'text_field'      => 'Text Field 1 Demo',
    'text_area_field' => 'Text Area Demo',
    'text_field2'     => 'Text Field 2 Demo',
    'password_field'  => '',
    'submit'          => 'submit',
    'reset'           => 'reset',
    'select'          => 2,
    'multi_select'    => [ 1, 11 ],
];

$selectOptions = [
    'Option 1'    => 1,
    'Option 2'    => 2,
    'Opt Group 1' => [ 'Opt Group 1 Option 1' => 11, 'Opt Group 1 Option 2' => 12 ],
    'Opt Group 2' => [ 'Opt Group 2 Option 1' => 21, 'Opt Group 2 Option 2' => 22 ],
];

$wpMenuPages = new \Pan\MenuPages\WpMenuPages( 'test', __DIR__, $defaults );

$menuPage = new \Pan\MenuPages\MenuPage( $wpMenuPages, 'Page title', 'Page subtitle' );

$tabA = new \Pan\MenuPages\PageComponents\Tab( $menuPage, 'Tab 1', true );
$tabB = new \Pan\MenuPages\PageComponents\Tab( $menuPage, 'Tab 2', false );

$panelATabA = new \Pan\MenuPages\PageComponents\Panel( $menuPage );
$panelBTabA = new \Pan\MenuPages\PageComponents\Panel( $menuPage );
$panelATabB = new \Pan\MenuPages\PageComponents\Panel( $menuPage );

$tabA->addPanel( $panelATabA )->addPanel( $panelATabB );
$tabB->addPanel( $panelBTabA );

$textFld     = new \Pan\MenuPages\Fields\Text( $panelATabA, 'text_field' );
$textFld->setLabel('Text Field 1 Label');

$textAreaFld = new \Pan\MenuPages\Fields\TextArea( $panelATabA, 'text_area_field' );

$textFld2 = new \Pan\MenuPages\Fields\Text( $panelATabB, 'text_field2' );

$passwordFld = new \Pan\MenuPages\Fields\Password( $panelBTabA, 'password_field' );

$submit = new \Pan\MenuPages\Fields\Submit( $panelBTabA, 'submit', 'Submit' );
$reset  = new \Pan\MenuPages\Fields\Reset( $panelBTabA, 'reset', 'Reset' );


echo $menuPage->getMarkUp();