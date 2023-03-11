<?php


namespace repositories;
use Illuminate\Database\Eloquent\Model;
use models\UserModel;

abstract class CoreRepositories extends Model
{
    /**@var Illuminate\Database\Capsule\Manager $model **/
    private $_model;

    public function __construct()
    {
       $this->_model = new($this->getModelClass());
    }

    protected abstract function getModelClass():string;

    protected function startCondition():UserModel
    {
        return clone $this->_model;
    }




}