<?php
ini_set( 'display_errors', 1 );

function get_option( $n, $d ) {
    return $d;
}

if(isset($_POST['submit'])){
    var_dump($_POST);
}

require_once 'vendor/autoload.php';

$defaults = [
    'text_demo'      => 'Text Demo',
    'text_area_demo' => 'Text Area Demo',
    'date_demo'      => '2015-11-10',
    'submit' => 'submit',
];

$wpMenuPages = new \Pan\MenuPages\WpMenuPages( 'test', __DIR__, $defaults );

$menuPage = new \Pan\MenuPages\MenuPage( $wpMenuPages );

$twig = $menuPage->getTwig()->getTwigEnvironment();

$mainSection = new \Pan\MenuPages\Sections\SectionMain( $menuPage );

$textField     = new \Pan\MenuPages\Fields\Text( $mainSection, 'text_demo' );
$textAreaField = new \Pan\MenuPages\Fields\TextArea( $mainSection, 'text_area_demo' );
$dateField     = new \Pan\MenuPages\Fields\Date( $mainSection, 'date_demo' );
$submit        = new \Pan\MenuPages\Fields\Submit( $mainSection, 'submit', 'Submit' );

$textField->setLabel( 'Text Demo Label' );
$textAreaField->setLabel( 'Text Area Demo Label' );
$dateField->setLabel( 'Date Demo Label' );
$submit->setClass('btn btn-lg btn-success col-md-5 pull-right');

$mainContent = $twig->render( 'blocks/form.twig', [ 'content' => $mainSection->getMarkUp() ] );

echo $twig->render( 'base.twig', [ 'main' => [ 'content' => $mainContent ] ] );