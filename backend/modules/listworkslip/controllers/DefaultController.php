<?php

namespace backend\modules\listworkslip\controllers;

use app\models\Sdptd04denpyosagyo;
use app\models\Sdptm01sagyo;
use backend\components\Utilities;
use backend\controllers\WsController;
use Yii;
use app\models\Sdptd03denpyo;
use yii\data\Pagination;

class DefaultController extends WsController
{
    public function actionIndex()
    {
        $all = new Utilities();
        $branch = $all->getAllBranch();
        $data['all_ss'] = $branch['all_ss'];

        $obj = new Sdptd03denpyo();
        $obj_job = new Sdptm01sagyo();
        $filters = Yii::$app->request->get();
        $data['filters'] = $filters;
        $count = $obj->countDataSearch($data['filters']);
        $data['pagination'] = new Pagination([
            'totalCount' => $count,
            'defaultPageSize' => Yii::$app->params['defaultPageSize'],
        ]);

        $data['filters']['limit'] = $data['pagination']->limit;
        $data['filters']['offset'] = $data['pagination']->offset;
        $data['list'] = $obj->getDataSearch($data['filters']);

        $data['job'] = array();
        $all_job = $obj_job->getData();
        foreach ($all_job as $k => $v) {
            $data['job'][''] = '';
            $data['job'][$v['M01_SAGYO_NO']] = $v['M01_SAGYO_NAMEN'];
        }

        $data['status'] = Yii::$app->params['status'];
        return $this->render('index', $data);
    }

    public static function getJob($order_id)
    {
        $result = array();
        $obj = new Sdptd04denpyosagyo();
        $job = $obj->getData(['D04_DEN_NO' => $order_id]);
        if (!empty($job)) {
            foreach ($job as $k => $v) {
                $result[] = $v['D04_SAGYO_NO'];
            }
        }
        return $result;
    }
}