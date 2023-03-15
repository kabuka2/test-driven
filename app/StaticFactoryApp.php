<?php


namespace app;

use app\Db\DataBase;
use app\Config\Config;

class StaticFactoryApp
{
    public static function build(string $type_obj)
    {
        switch ($type_obj) {
            case 'config':
                /** @var Config **/
                return Config::getInstance();
            case 'router':
                /**@var Router **/
                return new Router();
            case 'data_base':
               return (new DataBase())->init();
            default:
                throw_if(true, 'Type not found');

        }
    }
}