<?php
/**
 * @file: FrontControllerConfig.php
 * @author Alex Maystrenko <ashterix69@gmail.com>
 *
 * Class - FrontControllerConfig
 *
 * Created by PhpStorm.
 * Date: 08.01.2016
 * Time: 12:32
 */

namespace UfoCms\FrontController\Components;


class FrontControllerConfig
{
    const ENV_PROD = 'prod';
    const ENV_DEV = 'dev';
    const ENV_TEST = 'test';

    /**
     * @var string
     */
    protected $environment = self::ENV_PROD;

    /**
     * @var string | null
     */
    protected $accessToken = null;

    /**
     * @var array
     */
    protected $allowedIP = [
        '127.0.0.1', 'fe80::1', '::1'
    ];

    /**
     * @var bool
     */
    protected $debugMode = false;

    /**
     * @var bool
     */
    protected $loadClassCache = true;

    /**
     * FrontControllerConfig constructor.
     * @param string $environment
     * @param string | null $accessToken
     */
    public function __construct($environment = self::ENV_PROD, $accessToken = null)
    {
        $this->environment = $environment;
        $this->accessToken = $accessToken;
    }

    /**
     * @return string
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * @param string $environment
     * @return self
     */
    public function setEnvironment($environment)
    {
        $this->environment = $environment;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param null|string $accessToken
     * @return self
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    /**
     * @return array
     */
    public function getAllowedIP()
    {
        return $this->allowedIP;
    }

    /**
     * @param string $allowedIP
     * @return self
     */
    public function addAllowedIP($allowedIP)
    {
        $this->allowedIP[] = $allowedIP;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isDebugMode()
    {
        return $this->debugMode;
    }

    /**
     * @param boolean $debugMode
     * @return self
     */
    public function setDebugMode($debugMode)
    {
        $this->debugMode = (bool)$debugMode;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isLoadClassCache()
    {
        return $this->loadClassCache;
    }

    /**
     * @param boolean $loadClassCache
     * @return self
     */
    public function setLoadClassCache($loadClassCache)
    {
        $this->loadClassCache = $loadClassCache;
        return $this;
    }
}