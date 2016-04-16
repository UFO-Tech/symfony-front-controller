<?php
/**
 * Created by PhpStorm.
 * User: ashterix
 * Date: 16.04.16
 * Time: 11:09
 */

namespace UfoCms\FrontControllerBundle\Controller;


use UfoCms\FrontControllerBundle\Components\FrontController;
use UfoCms\FrontControllerBundle\Components\FrontControllerConfig;

class App extends FrontController
{
    public static function init()
    {
        $controller = parent::init(FrontControllerConfig::ENV_PROD);
        $controller ->getConfig()
            ->setDebugMode(false)
            ->setLoadClassCache(true)
        ;
        return $controller;
    }
}