<?php

namespace backend\modules\maintenance\controllers;

use backend\controllers\WsController;

class DefaultController extends WsController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
