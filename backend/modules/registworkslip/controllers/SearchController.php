<?php

namespace backend\modules\registworkslip\controllers;

use app\models\Sdptm05com;
use Yii;
use backend\controllers\WsController;
use yii\data\Pagination;

class SearchController extends WsController
{
    public function actionIndex()
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $obj = new Sdptm05com();
            $condition = $request->post('condition');
            $data['filters'][$condition] = $request->post('value');
            $data['count'] = $obj->coutData($data['filters']);
            $data['pagination'] = new Pagination([
                'totalCount'      => $data['count'],
                'defaultPageSize' => 10,
                'page' => $request->post('page')
            ]);

            $data['filters']['offset'] = $data['pagination']->offset;
            $data['filters']['limit'] = $data['pagination']->limit;

            $data['product'] = $obj->getData($data['filters']);
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $data;
        }
    }
}
