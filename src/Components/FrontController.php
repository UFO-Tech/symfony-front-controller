<?php
/**
 * @file: FrontController.php
 * @author Alex Maystrenko <ashterix69@gmail.com>
 *
 * Class - FrontController
 *
 * Created by PhpStorm.
 * Date: 08.01.2016
 * Time: 11:44
 */

namespace UfoCms\FrontController\Components;


use AppKernel;
use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;

abstract class FrontController
{
    /**
     * @var FrontControllerConfig
     */
    protected $config;

    /**
     * @var FrontController
     */
    protected static $instance;

    /**
     * FrontController constructor.
     * @param string $environment
     */
    protected function __construct($environment = FrontControllerConfig::ENV_PROD)
    {
        mb_internal_encoding("UTF-8");
        $this->config = new FrontControllerConfig($environment);
    }

    protected function checkAccess()
    {
        if ($this->getConfig()->getEnvironment() != FrontControllerConfig::ENV_DEV) {
            return true;
        }

        if (isset($_SERVER['HTTP_CLIENT_IP'])
            || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
            || !(in_array(@$_SERVER['REMOTE_ADDR'], $this->getConfig()->getAllowedIP()) || php_sapi_name() === 'cli-server')
        ) {
            if (!$this->getConfig()->getAccessToken() || !isset($_COOKIE['debug']) || $_COOKIE['debug'] != $this->getConfig()->getAccessToken()) {
                InAppDetector::redirect(InAppDetector::URL_404, 'You are not allowed to access this file');
            }
        }
        return false;
    }

    public function handleRequest()
    {
        $this->checkAccess();

        if ($this->getConfig()->isDebugMode()) {
            Debug::enable();
        }
        $kernel = new AppKernel(
            $this->getConfig()->getEnvironment(),
            $this->getConfig()->isDebugMode()
        );

        if ($this->getConfig()->isLoadClassCache()) {
            $kernel->loadClassCache();
        }

        $request = Request::createFromGlobals();
        $response = $kernel->handle($request);

        if ($request->getPathInfo() == '/login') {
            $response->headers->add([
                'UFO-Action' => 'login',
                'UFO-Referer' => $request->server->get('HTTP_REFERER'),
            ]);
        }

        $response->send();
        $kernel->terminate($request, $response);
        return true;
    }

    /**
     * @return FrontControllerConfig
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Close clone
     */
    private function __clone() {}

    /**
     * @param string $environment
     * @return FrontController
     */
    protected static function initController($environment = FrontControllerConfig::ENV_PROD){
        $controller = self::getInstance();
        if (!$controller) {
            $controller = new static($environment);
            static::setInstance($controller);
        }
        return $controller;
    }

    /**
     * Getter for FrontController instance
     *
     * @return FrontController
     */
    private static function getInstance()
    {
        return static::$instance;
    }

    /**
     * Set API instance
     *
     * @param FrontController $instance
     */
    private static function setInstance(FrontController $instance)
    {
        static::$instance = $instance;
    }
}