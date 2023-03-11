<?php


namespace models;
use app\traits\PropertyContainerTrait;
use app\db\DataBase;
use Illuminate\Database\Eloquent\Model;

abstract class CoreModel extends Model
{
    use PropertyContainerTrait;

    protected $table = 'user'; // table name
    protected $primaryKey = ''; // first key

    public function __construct()
    {
        $this->getTable();
        parent::__construct();
    }










}