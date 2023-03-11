<?php

namespace controller;
use repositories\UserRepositories as Model;

class SiteController extends BaseController
{
    private object $_models;

    public function __construct()
    {
        parent::__construct();
        $this->_models = new Model();
    }

    public function actionIndex()
    {

       return $this->render('index');
    }

    public function actionSaveUser()
    {

        return $this->renderAjax('', (new \models\UsersTest)->save($_POST) );
    }

    public function actionError404()
    {
        echo '404';
        exit();
    }

}
