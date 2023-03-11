<?php


$config_all = require '../config.php';
$config_db = require '../db.php';
$bootstrap = require '../bootstrap/bootstrap.php';
$config = array_merge($config_all,$config_db,['bootstrap' => $bootstrap]);
/** @var $config **/
(new app\App($config))->run();
?>