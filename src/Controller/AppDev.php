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

class AppDev extends FrontController
{
    public static function init()
    {
        $controller = parent::init(FrontControllerConfig::ENV_DEV);
        $controller ->getConfig()
            ->addAllowedIP('127.0.0.1')
            ->setDebugMode(true)
            ->setLoadClassCache(false)
        ;
        return $controller;
    }
}