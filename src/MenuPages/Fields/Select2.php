<?php
/**
 * Select2.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\Fields;

use Pan\MenuPages\PageElements\Components\Abs\AbsCmpFields;
use Pan\MenuPages\Scripts\Script;

/**
 * Class Select2
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-21
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\Fields
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class Select2 extends Select {
    protected $select2options = [ ];
    protected $multiple;

    public function __construct( AbsCmpFields $component, $name ) {
        parent::__construct( $component, $name );
        Script::getInstance( $this->menuPageComponent->getMenuPage() )->requireSelect2();
    }

    public function getTemplateName() {
        return 'fields/select2.twig';
    }

    public function setSelect2option( $name, $value ) {
        $this->select2options[ $name ] = $value;

        return $this;
    }

    public function getSelect2options() {
        return $this->select2options;
    }

    public function setPlaceHolder( $placeholder ) {
        $this->setSelect2option( 'placeholder', $placeholder );

        return $this;
    }

    /**
     *
     * @param array $optionsData Should be assoc array like:
     *                           <pre>
     *                           [
     *                           0 => [
     *                           'id' => $optionId
     *                           'text' => $optionLabel
     *                           ],
     *                           1 => [
     *                           // ... more options
     *                           ],
     *                           // ... more options
     *                           ]
     *                           </pre>
     *
     * @return $this
     */
    public function setData( $optionsData ) {
        $this->setSelect2option( 'data', $optionsData );

        return $this;
    }

    public function getMultiple() {
        return $this->multiple;
    }

    public function setMultiple( $multiple ) {
        $this->multiple = $multiple ? 'multiple' : null;

        return $this;
    }
}