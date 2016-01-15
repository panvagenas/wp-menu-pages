<?php
/**
 * CmpForm.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-12-04
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\PageComponents\Elements
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */

namespace Pan\MenuPages\PageElements\Components;

use Pan\MenuPages\PageElements\Components\Abs\AbsFldCmp;

/**
 * Class CmpForm
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-12-04
 * @since     TODO ${VERSION}
 * @package   Pan\MenuPages\PageComponents\Elements
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */
class CmpForm extends AbsFldCmp{
    /**
     * @var string
     */
    protected $method = 'post';
    /**
     * @var string
     */
    protected $action = '';
    /**
     * @var string
     */
    protected $encType= '';
    /**
     * @var string
     */
    protected $target = '';
    /**
     * @var string
     */
    protected $class = 'form-horizontal';

    protected $templateName = 'form.twig';

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    Form::$class
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getClass() {
        return $this->class;
    }

    /**
     * Setter for {@link CmpForm::$class}
     *
     * @param string $class
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function setClass( $class ) {
        $this->class = $class;

        return $this;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    Form::$action
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getAction() {
        return $this->action;
    }

    /**
     * Setter for {@link CmpForm::$action}
     *
     * @param string $action
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function setAction( $action ) {
        $this->action = $action;

        return $this;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    Form::$encType
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getEncType() {
        return $this->encType;
    }

    /**
     * Setter for {@link CmpForm::$encType}
     *
     * @param string $encType
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function setEncType( $encType ) {
        $this->encType = $encType;

        return $this;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    Form::$method
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getMethod() {
        return $this->method;
    }

    /**
     * Setter for {@link CmpForm::$method}
     *
     * @param string $method
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function setMethod( $method ) {
        $this->method = $method;

        return $this;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    Form::$target
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getTarget() {
        return $this->target;
    }

    /**
     * Setter for {@link CmpForm::$target}
     *
     * @param string $target
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function setTarget( $target ) {
        $this->target = $target;

        return $this;
    }

}