<?php


namespace models;
use repositories\User;

class UserModel extends CoreModel
{
    protected $table = 'user'; // table name
    protected $primaryKey = ''; // first key

    public function __construct()
    {
        parent::__construct();
    }

    protected function fields():array
    {
       return [

       ];
    }
}