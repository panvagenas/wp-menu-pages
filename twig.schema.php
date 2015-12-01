<?php

$menuPageTwigSchema = [
    'page'  => [
        'title'    => $title,
        'subtitle' => $subtitle,
    ],
    'form'  => [
        'method'  => $method,
        'action'  => $action,
        'encType' => $encType,
    ],
    'tabs'  => [
        $tabId => $tabInstance
        // ... more instances of tab
    ],
    'aside' => [
        $sideBarId => $sideBarInstance
        // ... more instances of sidebar
    ],
    'alerts' => [
        $alertId => $alert,
        // ... moire instances of alert
    ]
];
