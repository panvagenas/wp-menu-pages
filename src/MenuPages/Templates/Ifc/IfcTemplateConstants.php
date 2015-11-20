<?php

namespace Pan\MenuPages\Templates\Ifc;

use Pan\MenuPages\Ifc\IfcConstants;

interface IfcTemplateConstants extends IfcConstants{
    const FILTER_PATHS_PREFIX = 'wp_menu_pages_filter_template_paths_';
    const FILTER_PATHS = 'wp_menu_pages_filter_template_paths';
    const NO_TEMPLATE_PATH = 'misc/no-template.twig';
}