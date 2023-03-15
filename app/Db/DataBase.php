<?php
namespace app\Db;

use app\interfaces\LoadClassInterface;
use Illuminate\Database\Capsule\Manager as Capsule;

class DataBase extends Capsule implements LoadClassInterface
{
    private $capsule;
    public function __construct()
    {
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'mydatabase',
            'username' => 'myusername',
            'password' => 'mypassword',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        $this->capsule = $capsule;
    }

    public function init()
    {
        return $this->capsule;
    }


    public function run()
    {
        $this->init();
    }
}





?>