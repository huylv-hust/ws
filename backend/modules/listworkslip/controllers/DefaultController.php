<?php

namespace backend\modules\listworkslip\controllers;

use app\models\Sdptd04denpyosagyo;
use app\models\Sdptm01sagyo;
use backend\components\utilities;
use backend\controllers\WsController;
use Yii;
use app\models\Sdptd03denpyo;
use yii\data\Pagination;
use yii\helpers\BaseUrl;

/**
 * Class DefaultController
 * @package backend\modules\listworkslip\controllers
 */
class DefaultController extends WsController
{
    /**
     * list order
     * @return string
     */
    public function actionIndex()
    {
        $all = new utilities();
        $branch = $all->getAllBranch();
        $data['all_ss'] = $branch['all_ss'];

        $obj = new Sdptd03denpyo();
        $obj_job = new Sdptm01sagyo();
        $filters = Yii::$app->request->get();

        $query_string = empty($filters) ? '' : '?' . http_build_query($filters);
        Yii::$app->session->set('url_list_workslip', BaseUrl::base() . '/list-workslip.html' . $query_string);

        if (empty($filters)) {
            $filters['start_time'] = date('Ymd');
            $filters['end_time'] = date('Ymd');
        }

        $data['filters'] = $filters;
        $count = $obj->countDataSearch($data['filters']);
        $data['pagination'] = new Pagination([
            'totalCount' => $count,
            'defaultPageSize' => Yii::$app->params['defaultPageSize'],
        ]);
        $data['page'] = $filters = Yii::$app->request->get('page');
        $data['filters']['limit'] = $data['pagination']->limit;
        $data['filters']['offset'] = $data['pagination']->offset;
        $data['list'] = $obj->getDataSearch($data['filters']);
        if (empty($data['list'])) {
            Yii::$app->session->setFlash('empty', '入力条件に該当する作業伝票が存在しません');
        }
        $data['job'] = array();
        $all_job = $obj_job->getData();
        foreach ($all_job as $k => $v) {
            $data['job'][''] = '';
            $data['job'][$v['M01_SAGYO_NO']] = $v['M01_SAGYO_NAMEN'];
        }

        $data['status'] = Yii::$app->params['status'];
        Yii::$app->params['titlePage'] = '作業伝票一覧';
        Yii::$app->view->title = '情報検索';
        return $this->render('index', $data);
    }

    /**
     * get job of order
     * @param $order_id
     * @return array
     */
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