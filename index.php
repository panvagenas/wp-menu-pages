<?php
ini_set( 'display_errors', E_ALL );

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
    'select'          => 2,
    'multi_select'    => [ 1, 11 ],
    'checkbox'        => [ 1, 2 ],
    'radio'           => 3,
    'switch' => 1
];

$selectOptions = [
    'Option 1'    => 1,
    'Option 2'    => 2,
    'Opt Group 1' => [ 'Opt Group 1 Option 1' => 11, 'Opt Group 1 Option 2' => 12 ],
    'Opt Group 2' => [ 'Opt Group 2 Option 1' => 21, 'Opt Group 2 Option 2' => 22 ],
];

$options = \Pan\MenuPages\Options::getInstance( 'test', $defaults );

$wpMenuPages = new \Pan\MenuPages\WpMenuPages( __DIR__, $options );

$menuPage = new \Pan\MenuPages\MenuPage( $wpMenuPages, 'Page title', 'Page subtitle' );

$tabA = new \Pan\MenuPages\PageComponents\Tab( $menuPage, 'Tab 1', true );
$tabB = new \Pan\MenuPages\PageComponents\Tab( $menuPage, 'Tab 2', false );

$tabA->setIcon( 'gear' );
$tabB->setIcon( 'gears' );

$textFld = new \Pan\MenuPages\Fields\Text( $tabA, 'text_field' );
$textFld->setLabel( 'Text Field 1 Label' );

$textAreaFld = new \Pan\MenuPages\Fields\TextArea( $tabA, 'text_area_field' );
$textAreaFld->setLabel( 'Text Area Demo' );

$textFld2 = new \Pan\MenuPages\Fields\Text( $tabB, 'text_field2' );
$textFld2->setLabel( 'Text Field 2 Demo' );

$passwordFld = new \Pan\MenuPages\Fields\Password( $tabB, 'password_field' );
$passwordFld->setLabel( 'Password Demo' );

$selectField = new Pan\MenuPages\Fields\Select( $tabA, 'select' );
$selectField->setLabel( 'Select Field Demo' )->setOptions( $selectOptions );

$select2Field = new Pan\MenuPages\Fields\Select2( $tabA, 'multi_select' );
$select2Field
    ->setPlaceHolder( 'Please Choose At Least One' )
    ->setSelect2option( 'allow_empty', false )
    ->setMultiple( true )
    ->setLabel( 'Select 2 Field Demo' )
    ->setOptions( $selectOptions );

$multiSelectField = new Pan\MenuPages\Fields\MultiSelect( $tabA, 'multi_select' );
$multiSelectField->setLabel( 'Multi Select Field Demo' )->setOptions( $selectOptions );

$aside  = new \Pan\MenuPages\PageComponents\Aside( $menuPage );
$panel1 = new \Pan\MenuPages\PageComponents\Panel( $menuPage, 'The Title' );
$panel2 = new \Pan\MenuPages\PageComponents\Panel( $menuPage, 'Another Title' );

$passwordFld2 = clone $passwordFld;
$passwordFld2->setLabel( '' )->setPlaceholder( 'Pass Field Demo' );

$textFld2 = clone $textFld;
$textFld2->setLabel( '' )->setPlaceholder( 'Text Field Demo' );

$panel1->attachField( $passwordFld2 );
$panel2->attachField( $textFld2 );

$aside->addPanel( $panel1 )->addPanel( $panel2 );

$fb = new \Pan\MenuPages\PageComponents\Social( $menuPage, 'FaceBook',
    \Pan\MenuPages\PageComponents\Social::ICON_FACEBOOK, '#fb' );
$gh = new \Pan\MenuPages\PageComponents\Social( $menuPage, 'GitHub', \Pan\MenuPages\PageComponents\Social::ICON_GITHUB,
    '#gh' );

$checkBox = new \Pan\MenuPages\Fields\CheckBox( $tabA, 'checkbox' );
$checkBox->setOptions( [ 'First Option' => 1, 'Second Option' => 2, 'Third Option' => 3, ] )
         ->setLabel( 'Checkbox demo' );

$radio = new \Pan\MenuPages\Fields\Radio( $tabA, 'radio' );
$radio->setOptions( [ 'First Option' => 1, 'Second Option' => 2, 'Third Option' => 3, ] )
      ->setLabel( 'Radio demo' )
      ->setButtonClass( \Pan\MenuPages\Fields\Radio::BUTTON_CLASS_DANGER );

$switch = new \Pan\MenuPages\Fields\SwitchField($tabA, 'switch');


echo $menuPage->getMarkUp();