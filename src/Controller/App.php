<?php
/**
 * Created by PhpStorm.
 * User: ashterix
 * Date: 16.04.16
 * Time: 11:09
 */

namespace UfoCms\FrontController\Controller;


use UfoCms\FrontController\Components\FrontController;
use UfoCms\FrontController\Components\FrontControllerConfig;

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