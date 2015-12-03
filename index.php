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

$textFld     = new \Pan\MenuPages\Fields\Text( $tabA, 'text_field' );
$textFld->setLabel('Text Field 1 Label');

$textAreaFld = new \Pan\MenuPages\Fields\TextArea( $tabA, 'text_area_field' );
$textAreaFld->setLabel('Text Area Demo');

$textFld2 = new \Pan\MenuPages\Fields\Text( $tabB, 'text_field2' );
$textFld2->setLabel('Text Field 2 Demo');

$passwordFld = new \Pan\MenuPages\Fields\Password( $tabB, 'password_field' );
$passwordFld->setLabel('Password Demo');

$selectField = new Pan\MenuPages\Fields\Select($tabA, 'select');
$selectField->setLabel('Select Field Demo')->setOptions($selectOptions);

$select2Field = new Pan\MenuPages\Fields\Select2($tabA, 'multi_select');
$select2Field
        ->setPlaceHolder('Please Choose At Least One')
        ->setSelect2option('allow_empty', FALSE)
        ->setMultiple(true)
        ->setLabel('Select 2 Field Demo')
        ->setOptions($selectOptions);

$multiSelectField = new Pan\MenuPages\Fields\MultiSelect($tabA, 'multi_select');
$multiSelectField->setLabel('Multi Select Field Demo')->setOptions($selectOptions);

$aside = new \Pan\MenuPages\PageComponents\Aside($menuPage);
$panel1 = new \Pan\MenuPages\PageComponents\Panel($menuPage, 'The Title');
$panel2 = new \Pan\MenuPages\PageComponents\Panel($menuPage, 'Another Title');

$panel1->attachField($passwordFld);
$panel2->attachField($textFld);

$aside->addPanel($panel1)->addPanel($panel2);

$fb = new \Pan\MenuPages\PageComponents\Social($menuPage, 'FaceBook', \Pan\MenuPages\PageComponents\Social::ICON_FACEBOOK, '#fb');
$gh = new \Pan\MenuPages\PageComponents\Social($menuPage, 'GitHub', \Pan\MenuPages\PageComponents\Social::ICON_GITHUB, '#gh');


echo $menuPage->getMarkUp();