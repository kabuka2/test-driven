<?php


namespace app;


use app\Interfaces\AppBuilderInterface;

class AppBuilderBootstrap implements AppBuilderInterface
{
    private $_object;

    public function __construct()
    {
        $this->create();
    }

    public function create(): AppBuilderInterface
    {
       $this->_object = new class{};
       return $this;
    }

    public function singleton():AppBuilderInterface
    {
        if (!isset($this->_object->singleton)) {
            $this->_object->singleton = func_get_args();
        } else {
            $this->_object->singleton = array_merge($this->_object->singleton,func_get_args());
        }
        return $this;
    }

    public function newObject():AppBuilderInterface
    {
        if (!isset($this->_object->new)) {
            $this->_object->new = func_get_args();
        } else {
            $this->_object->new = array_merge($this->_object->new,func_get_args());
        }
        return $this;

    }


    public function build()
    {
        $data = $this->_object;
        $this->create();
        $temp = $this->_object;
        foreach ($data as $type_class => $classes)
        {
            foreach ($classes as $name_spaces) {
                if ($type_class == 'singleton') {
                    $temp->$name_spaces = $name_spaces::getInstance()->run();
                }

                if ($type_class == 'new') {
                    $temp->$name_spaces = (new $name_spaces())->run();
                }
            }
        }
        return $temp;
    }
}