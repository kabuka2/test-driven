<?php
require_once '../vendor/autoload.php';

use app\Db\DataBase;
use Illuminate\Database\Eloquent\Model;
$appBuild = new \app\AppBuilderBootstrap();

//$appBuild->singleton(
//    DataBase::class,
//);
$appBuild->newObject(
    DataBase::class,
);
//Model::shouldBeStrict(\app\App::getConfig());
return $appBuild;


?>