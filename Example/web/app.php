<?php


use UfoCms\FrontControllerBundle\Controller\App;

umask(0000);

/**
 * @var Composer\Autoload\ClassLoader $loader
 */
$loader = require __DIR__.'/../app/autoload.php';
include_once __DIR__.'/../app/bootstrap.php.cache';

$frontController = App::init();
$frontController->handleRequest();
