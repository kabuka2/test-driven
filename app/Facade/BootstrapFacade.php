<?php


namespace app\facade;
use app\StaticFactoryApp;

class BootstrapFacade
{

    public function init(array $config)
    {
        $boot  = $config['bootstrap'];
        unset($config['bootstrap']);
        StaticFactoryApp::build('config')->setConfig($config);
        $boot->build();
    }



}