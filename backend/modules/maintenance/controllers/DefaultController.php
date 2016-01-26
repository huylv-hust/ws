<?php

namespace backend\modules\maintenance\controllers;

use Yii;
use backend\controllers\WsController;

class DefaultController extends WsController
{
    public function actionIndex()
    {
        Yii::$app->params['titlePage'] = 'メンテナンス';
        Yii::$app->view->title = 'メンテナンス';
        return $this->render('index');
    }
}
