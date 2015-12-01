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
    'text_demo'      => 'Text Demo',
    'text_area_demo' => 'Text Area Demo',
    'date_demo'      => '2015-11-10',
    'submit'         => 'submit',
    'reset'          => 'reset',
    'select'         => 2,
    'multi_select'   => [ 1, 11 ],
];

$selectOptions = [
    'Option 1'    => 1,
    'Option 2'    => 2,
    'Opt Group 1' => [ 'Opt Group 1 Option 1' => 11, 'Opt Group 1 Option 2' => 12 ],
    'Opt Group 2' => [ 'Opt Group 2 Option 1' => 21, 'Opt Group 2 Option 2' => 22 ],
];

$wpMenuPages = new \Pan\MenuPages\WpMenuPages( 'test', __DIR__, $defaults );

$menuPage = new \Pan\MenuPages\MenuPage( $wpMenuPages );

$twig = $menuPage->getTwig()->getTwigEnvironment();

$mainSection = new \Pan\MenuPages\Sections\SectionMain( $menuPage );

$textField     = new \Pan\MenuPages\Fields\Text( $mainSection, 'text_demo' );
$textAreaField = new \Pan\MenuPages\Fields\TextArea( $mainSection, 'text_area_demo' );
$dateField     = new \Pan\MenuPages\Fields\Date( $mainSection, 'date_demo' );
$select        = new \Pan\MenuPages\Fields\Select( $mainSection, 'select' );
$multiSelect   = new \Pan\MenuPages\Fields\MultiSelect( $mainSection, 'multi_select' );

$submit = new \Pan\MenuPages\Fields\Submit( $mainSection, 'submit', 'Submit' );
$reset  = new \Pan\MenuPages\Fields\Reset( $mainSection, 'reset', 'Reset' );

$textField->setLabel( 'Text Demo Label' );
$textAreaField->setLabel( 'Text Area Demo Label' );
$dateField->setLabel( 'Date Demo Label' );
$select->setOptions($selectOptions);
$multiSelect->setOptions($selectOptions);

$submit->setClass( 'btn btn-lg btn-success col-md-5 pull-right' );
$reset->setClass( 'btn btn-lg btn-warning col-md-5 pull-right' );

//$mainContent = $twig->render( 'blocks/form.twig', [ 'content' => $mainSection->getMarkUp() ] );
//
//echo $twig->render( 'base.twig', [ 'main' => [ 'content' => $mainContent ] ] );

class testFieldClass extends stdClass{
    protected $label = 'The field label';
    function getLabel(){
        return $this->label;
    }
}
$tabInstance = new stdClass();
$tabInstance2 = new stdClass();
$sectionInstance = new stdClass();
$fieldInstance = new testFieldClass();

$fieldInstance->getTemplateName = 'fields/input.twig';

$fieldInstance->type = 'text';
$fieldInstance->name = 'text-input-name';
$fieldInstance->id = 'field-id';
$fieldInstance->value = 'Text field value';
$fieldInstance->class = 'form-control';
$fieldInstance->placeholder = 'This is the placeholder';

$sectionInstance->title = 'The section title';
$sectionInstance->subtitle = 'and the section subtitle';
$sectionInstance->fields = [
    $fieldInstance->id => $fieldInstance
];

$tabInstance->navTitle = 'Tab title';
$tabInstance->tabId = 'the-tab-id';
$tabInstance->sections = [
    'sectionId' => $sectionInstance
];

$tabInstance2->navTitle = 'Tab title 2';
$tabInstance2->tabId = 'the-tab-id2';
$tabInstance2->sections = [
    'sectionId' => $sectionInstance
];


$menuPageTwigSchema = [
    'page'  => [
        'title'    => 'The page title',
        'subtitle' => 'and the subtitle',
    ],
    'form'  => [
        'method'  => 'post',
        'action'  => '#',
        'encType' => '',
    ],
    'tabs'  => [
        'tabId' => $tabInstance,
        'tabId2' => $tabInstance2
        // ... more instances of tab
    ],
//    'aside' => [
//        $sideBarId => $sideBarInstance
//        // ... more instances of sidebar
//    ],
];

echo $twig->render('base.twig', $menuPageTwigSchema);