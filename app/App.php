<?php


namespace app;
use app\facade\BootstrapFacade;
use app\config\Config;

class App
{
    public function __construct(array $config)
    {
        (new BootstrapFacade())->init($config);
    }

//************************************************** get **************************************************************/
    /**
     * @return Config;
    **/
    public static function getConfig():Config
    {
        /**@var Config **/
        return StaticFactoryApp::build('config');
    }
    /**@var Router**/
    public static function getRouter():Router
    {
        /**@var Router**/
        return StaticFactoryApp::build('router');
    }

    public static function db()
    {
        return StaticFactoryApp::build('data_base');
    }

    public static function isDev():bool
    {
        return self::getConfig()->getConfigToPath('is_develop');
    }

//************************************************* base logic *******************************************************//
    public function run()
    {
        self::getRouter()->redirectAction();
    }

}