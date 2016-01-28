<?php
namespace backend\modules\registworkslip\controllers;

use app\models\Sdptm01sagyo;
use backend\components\utilities;
use backend\controllers\WsController;
use yii\helpers\BaseUrl;

class PreviewController extends WsController
{
    public function actionIndex()
    {
        $data['post'] = \Yii::$app->request->post();
        if (isset($data['post']['D01_SS_CD'])) {
            $branch = utilities::getAllBranch();
            $ss = $branch['all_ss'];
            $address = $branch['ss_address'];
            $tel = $branch['ss_tel'];

            $obj_job = new Sdptm01sagyo();

            $job[''] = '';
            $all_job = $obj_job->getData();
            foreach ($all_job as $k => $v) {
                $job[$v['M01_SAGYO_NO']] = $v['M01_SAGYO_NAMEN'];
            }

            $data['ss'] = isset($ss[$data['post']['D01_SS_CD']]) ? $ss[$data['post']['D01_SS_CD']] : '';
            $data['address'] = isset($address[$data['post']['D01_SS_CD']]) ? $address[$data['post']['D01_SS_CD']] : '';
            $data['tel'] = isset($tel[$data['post']['D01_SS_CD']]) ? $tel[$data['post']['D01_SS_CD']] : '';

            foreach ($data['post']['LIST_NAME'] as $k => $v) {
                $data['post']['M05_COM_NAMEN' . $k] = $v;
            }

            $data['job'] = $job;
            $data['status'] = \Yii::$app->params['status'];

            $this->layout = '@app/views/layouts/print';
            \Yii::$app->view->title = '作業確認書';
            \Yii::$app->params['titlePage'] = '作業確認書';

            return $this->render('index', $data);
        }
        return $this->redirect(BaseUrl::base(true).'/regist-workslip');
    }

}