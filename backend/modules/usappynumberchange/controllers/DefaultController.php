<?php

namespace backend\modules\usappynumberchange\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $cookie = \Yii::$app->request->cookies;
        $cus_info = $cookie->getValue('cus_info', '0');
        if ($cus_info == 0) {
            return $this->goHome();
        }
        $data['member_kaiinCd'] = $cus_info['member_kaiinCd'];
        return $this->render('index', $data);
    }
}
