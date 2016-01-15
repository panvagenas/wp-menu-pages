<?php

namespace Pan\MenuPages\PageElements\Abs;

use Pan\MenuPages\Ifc\IfcDisplayable;
use Pan\MenuPages\Trt\TrtIdentifiable;

abstract class AbsElement implements IfcDisplayable {
    use TrtIdentifiable;

    protected $templatesDir = '';
    protected $templateName = '';

    public function getTemplateName() {
        return $this->templatesDir . '/' . $this->templateName;
    }
}