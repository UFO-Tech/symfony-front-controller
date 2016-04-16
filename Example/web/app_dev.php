<?php

use UfoCms\FrontControllerBundle\Controller\AppDev;

umask(0000);

/**
 * @var Composer\Autoload\ClassLoader $loader
 */
$loader = require __DIR__.'/../app/autoload.php';


$frontController = AppDev::init(); // init dev front controller
$frontController->getConfig()
    ->addAllowedIP('127.0.0.1') // add some ip for access to dev environment 
    ->setAccessToken('someTokenForAccessToApDevEnvironment')
;
$frontController->handleRequest();
