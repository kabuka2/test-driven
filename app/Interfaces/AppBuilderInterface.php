<?php


namespace app\interfaces;


interface AppBuilderInterface
{

    public function __construct();

    /**@return AppBuilderInterface**/
    public function create():AppBuilderInterface;


    public function build();




}