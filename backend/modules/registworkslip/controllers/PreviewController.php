<?php
namespace backend\modules\registworkslip\controllers;

use app\models\Sdptm01sagyo;
use app\models\Udenpyo;
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


            $tanto = explode('[]', $data['post']['D03_TANTO_MEI_D03_TANTO_SEI']);
            if (!empty($tanto[0]) && !empty($tanto[1])) {
                $data['post']['tanto'] = $tanto[0] . $tanto[1];
            }

            $kakunin = explode('[]', $data['post']['D03_KAKUNIN_MEI_D03_KAKUNIN_SEI']);
            if (!empty($kakunin[0]) && !empty($kakunin[1])) {
                $data['post']['kakunin'] = $kakunin[0] . $kakunin[1];
            }

            $data['post']['ss_user'] = $this->getssUser($data['post']['D01_SS_CD']);
            $data['ss_user'] = $data['post']['M08_NAME_MEI_M08_NAME_SEI'] ? $data['post']['ss_user'][$data['post']['M08_NAME_MEI_M08_NAME_SEI']] : '';

            $this->layout = '@app/views/layouts/print';
            \Yii::$app->view->title = '作業確認書';
            \Yii::$app->params['titlePage'] = '作業確認書';

            return $this->render('index', $data);
        }
        return $this->redirect(BaseUrl::base(true) . '/regist-workslip');
    }

    public function getssUser($sscode)
    {
        $uDenpyo = new Udenpyo();
        $tm08Sagyosya = $uDenpyo->getTm08Sagyosya(['M08_SS_CD' => $sscode]);
        $ssUser = [];
        if (count($tm08Sagyosya)) {
            foreach ($tm08Sagyosya as $tmp) {
                $ssUser[$tmp['M08_JYUG_CD']] = $tmp['M08_NAME_SEI'] . $tmp['M08_NAME_MEI'];
            }
        }
        return $ssUser;
    }
}
