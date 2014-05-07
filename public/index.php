<?php

use Phalcon\Config,
    Phalcon\DI\FactoryDefault,
    Phalcon\Loader,
    Phalcon\Mvc\Router,
    Phalcon\Mvc\Url,
    Phalcon\Mvc\View,
    Phalcon\Mvc\View\Engine\Volt,
    Phalcon\Session\Adapter\Files as SessionFiles;

try {
    // Load the configuration
    $configFile = require('../app/config/config.php');
    $config = new Config($configFile);

    // Create the autoloader
    $loader = new Loader();
    $loader->registerDirs(array(
        $config->application->controllersDir
    ));
    $loader->register();

    // Create the DI
    $di = new FactoryDefault();
    $di->set('config', $config);                            // Allows use of config vars in views
    $di->set('volt', function ($view, $di) use ($config) {  // Initializes volt templating engine
        $volt = new Volt($view, $di);
        $volt->setOptions(array(
            'compiledPath' => $config->application->cacheDir . 'volt/'
        ));
        return $volt;
    });
    $di->set('view', function () use ($config) {            // Initializes view service
        $view = new View();
        $view->setViewsDir($config->application->viewsDir);
        $view->registerEngines(array(
            '.volt' => 'volt'
        ));
        return $view;
    });
    $di->set('url', function () use ($config) {             // Sets baseUrl
        $url = new Url();
        $url->setBaseUri($config->application->baseUri);
        return $url;
    });
    $di->set('router', function () use ($config) {          // Initializes all routes
        $router = new Router(false);
        $router->notFound(array(
            'controller' => 'index',
            'action' => 'notFound'
        ));
        $router->removeExtraSlashes(true);
        foreach($config['routes'] as $route => $items) {
            $router
                ->add($route, $items->params->toArray())
                ->setName($items->name);
        }
        return $router;
    });
    $di->set('session', function () {                       // Initializes session vars
        $session = new SessionFiles();
        $session->start();
        return $session;
    });

    $application = new Phalcon\Mvc\Application($di);
    echo $application->handle()->getContent();

} catch (Phalcon\Exception $e) {
    echo 'PhalconException: ', $e->getMessage();
} catch (PDOException $e) {
    echo 'PDOException: ', $e->getMessage();
}