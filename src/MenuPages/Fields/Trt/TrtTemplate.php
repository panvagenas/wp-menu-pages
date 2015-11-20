<?php

namespace Pan\MenuPages\Fields\Trt;

use Pan\MenuPages\Templates\Ifc\IfcTemplateConstants;

trait TrtTemplate {
    protected $templateName = IfcTemplateConstants::NO_TEMPLATE_PATH;

    public function getTemplatePath() {
        foreach ( (array)$this->getTemplateRoots() as $templatesRoot ) {
            $path = $path = realpath( "{$templatesRoot}/{$this->templateName}" );
            if ( file_exists( $path ) && is_file( $path ) && is_readable( $path ) ) {
                return $path;
            }
        }

        return '';
    }

    public function getTemplateName() {
        return $this->templateName;
    }

    abstract function getTemplateRoots();
}