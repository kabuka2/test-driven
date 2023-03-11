<?php

namespace repositories;
use models\UserModel as Model ;

class UserRepositories extends CoreRepositories
{

    public function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass():string
    {
        return Model::class;
    }

    public function test()
    {
        return Model::all();
    }
}