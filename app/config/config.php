<?php
/*
[database]
host        = localhost
username    = root
password    = root
name        = phalcon
*/

$application = array(
    'controllersDir'  => '../app/controllers/',
    'viewsDir'        => '../app/views/',
    'cacheDir'        => '../cache/',
    'baseUri'         => '/phalcon-boilerplate/'
);

$js = array(
    'jquery'    => '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js',
    'bootstrap' => '//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js'
);

$css = array(
    'bootstrap'   => '//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css',
    'fontawesome' => '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css'
);

$routes = array(
    '/:controller' => array(
        'params' => array(
            'controller' => 1
        ),
        'name' => 'default-pattern-controller-only'
    ),
    '/:controller/([a-zA-Z\-]+)/:params' => array(
        'params' => array(
            'controller' => 1,
            'action' => 2,
            'params' => 3
        ),
        'name' => 'default-pattern'
    ),
    '/' => array(
        'params' => array(
            'controller' => 'index',
            'action' => 'index'
        ),
        'name' => 'index'
    )
);

return array(
    'application' => $application,
    'js'          => $js,
    'css'         => $css,
    'routes'      => $routes
);