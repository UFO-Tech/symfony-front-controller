<?php
/**
 * @file: InAppDetector.php
 * @author Alex Maystrenko <ashterix69@gmail.com>
 *
 * Class - InAppDetector
 *
 * Created by PhpStorm.
 * Date: 08.01.2016
 * Time: 10:47
 */

namespace UfoCms\FrontController\Components;


final class InAppDetector
{
    /**
     * Message if redirect not working
     */
    const MSG_NOT_IN_APP = 'File can`t be loaded without application!';
    const MSG_CANT_REDIRECT = 'Can`t be redirecting';

    const URL_404 = '/404.html';

    /**
     * @var boolean
     */
    private static $init;

    /**
     * Init detector
     */
    public static function init()
    {
        self::$init = true;
    }

    /**
     * @param string $redirectUrl
     * @param string $alternativeMessage
     * @return bool
     */
    public static function check($redirectUrl = self::URL_404, $alternativeMessage = self::MSG_NOT_IN_APP)
    {
        if (!self::$init) {
            self::redirect($redirectUrl, $alternativeMessage);
        }
        return true;
    }

    /**
     * @param string $redirectUrl
     * @param string $alternativeMessage
     */
    public static function redirect($redirectUrl, $alternativeMessage = self::MSG_CANT_REDIRECT)
    {
        header('Location: ' . $redirectUrl);
        exit($alternativeMessage);
    }


}