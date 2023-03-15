<?php


namespace app\Traits;


trait InstancesTrait
{

    private static $instances = [];

    protected function __construct() {}

    protected function __clone() {}

    public function __wakeup() {}

    public static function getInstance()
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }
        return self::$instances[$cls];
    }

}