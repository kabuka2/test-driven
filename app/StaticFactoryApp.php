<?php


namespace app;

use app\db\DataBase;
use app\Config\Config;

class StaticFactoryApp
{
    public static function build(string $type_obj)
    {
        switch ($type_obj) {
            case 'config':
                /** @var Config **/
                $obj = Config::getInstance();
                break;
            case 'router':
                /**@var Router **/
                $obj = new Router();
                break;
            case 'data_base':
                $obj = (new DataBase())->init();
                break;
        }
        return $obj;
    }
}