<?php

namespace backend\modules\listworkslip\controllers;

use app\models\Sdptd02car;
use app\models\Sdptd03denpyo;
use app\models\Sdptd04denpyosagyo;
use app\models\Sdptd05denpyocom;
use app\models\Sdptm01sagyo;
use app\models\Sdptm05com;
use backend\components\utilities;
use backend\controllers\WsController;
use Yii;
use yii\helpers\BaseUrl;

class DetailController extends WsController
{
    public function actionIndex()
    {
        $data = array();
        $filter['detail_no'] = Yii::$app->request->get('den_no');
        $obj = new Sdptd03denpyo();
        $obj_job = new Sdptm01sagyo();

        $job[''] = '';
        $all_job = $obj_job->getData();
        foreach ($all_job as $k => $v) {
            $job[$v['M01_SAGYO_NO']] = $v['M01_SAGYO_NAMEN'];
        }

        $detail = $obj->getDataSearch($filter);
        if (empty($detail)) {
            $this->redirect(BaseUrl::base(true) . '/list-workslip.html');
        }

        $data['detail'] = $detail[0];
        $data['detail']['D02_SYAKEN_CYCLE'] = $this->getCar([
            'D02_CUST_NO' => $data['detail']['D03_CUST_NO'],
            'D02_CAR_NO' => $data['detail']['D03_CAR_NO']
        ]);
        $data['detail']['sagyo'] = $this->getSagyo($data['detail']['D03_DEN_NO']);
        $data['detail']['product'] = $this->getProduct($data['detail']['D03_DEN_NO']);

        $data['job'] = $job;
        $data['status'] = Yii::$app->params['status'];
        return $this->render('index', $data);
    }

    public function getCar($filters = array())
    {
        $obj = new Sdptd02car();
        $car_info = $obj->getData($filters);
        if (empty($car_info)) {
            return '';
        } else {
            return $car_info[0]['D02_SYAKEN_CYCLE'];
        }
    }

    public function getSagyo($den_no)
    {
        $obj = new Sdptd04denpyosagyo();
        $job_info = $obj->getData(['D04_DEN_NO' => $den_no]);
        $job = array();
        foreach ($job_info as $k => $v) {
            $job[$k]['D04_SAGYO_NO'] = $v['D04_SAGYO_NO'];
        }
        return $job;
    }

    public function getProduct($den_no)
    {
        $obj = new Sdptd05denpyocom();
        $product_info = $obj->getData(['D05_DEN_NO' => $den_no]);
        $product = array();
        foreach ($product_info as $k => $v) {
            $product[$k]['D05_SURYO'] = $v['D05_SURYO'];
            $product[$k]['D05_TANKA'] = $v['D05_TANKA'];
            $product[$k]['D05_KINGAKU'] = $v['D05_KINGAKU'];
            $product[$k]['D05_COM_CD'] = $v['D05_COM_CD'];
            $product[$k]['D05_NST_CD'] = $v['D05_NST_CD'];

            $obj_sdptm05com = Sdptm05com::findOne(array($v['D05_COM_CD'], $v['D05_NST_CD']));
            $product[$k]['M05_COM_NAMEN'] = $obj_sdptm05com['M05_COM_NAMEN'];
            $product[$k]['M05_LIST_PRICE'] = $obj_sdptm05com['M05_LIST_PRICE'];
        }
        return $product;
    }

    public function actionStatus()
    {
        $request = Yii::$app->request;
        if ($request->isPost) {
            $den_no = Yii::$app->request->post('den_no');
            $obj = Sdptd03denpyo::findOne($den_no);
            if (!isset($obj)) {
                return $this->redirect(BaseUrl::base(true) . '/list-workslip.html');
            }
            $status = $obj['D03_STATUS'];
            $status_update = $status == 0 ? 1 : 0;
            $obj->setData(['D03_STATUS' => $status_update], $den_no);
            if ($obj->saveData()) {
                Yii::$app->session->setFlash('success', '変更しました。');
                return $this->redirect(BaseUrl::base(true) . '/list-workslip.html');
            }
            Yii::$app->session->setFlash('error', '変更するできません。');
            return $this->redirect(BaseUrl::base(true) . '/detail-workslip.html?den_no=' . $den_no);
        }
    }

    public function actionRemove()
    {
        $request = Yii::$app->request;
        if ($request->isPost) {
            $den_no = Yii::$app->request->post('den_no');
            if ($data = Sdptd03denpyo::findOne($den_no)) {
                $cus_no = $data['D03_CUST_NO'];
                $car_no = $data['D03_CAR_NO'];

                $obj = new Sdptd03denpyo();
                if ($obj->deleteData(['den_no' => $den_no, 'cus_no' => $cus_no, 'car_no' => $car_no])) {
                    Yii::$app->session->setFlash('success', '伝票No.' . $den_no . 'を削除しました。');
                    return $this->redirect(BaseUrl::base(true) . '/list-workslip.html');
                }
            }
            Yii::$app->session->setFlash('error', '削除をできません。');
            return $this->redirect(BaseUrl::base(true) . '/detail-workslip.html?den_no=' . $den_no);
        }
    }


    public function actionPreview()
    {
        $branch = utilities::getAllBranch();
        $ss = $branch['all_ss'];
        $address = $branch['ss_address'];
        $tel = $branch['ss_tel'];

        $filter['detail_no'] = \Yii::$app->request->get('den_no');
        $obj = new Sdptd03denpyo();
        $obj_job = new Sdptm01sagyo();

        $job[''] = '';
        $all_job = $obj_job->getData();
        foreach ($all_job as $k => $v) {
            $job[$v['M01_SAGYO_NO']] = $v['M01_SAGYO_NAMEN'];
        }

        $detail = $obj->getDataSearch($filter);
        if (empty($detail)) {
            $this->redirect(BaseUrl::base(true) . '/list-workslip.html');
        }

        $data['detail'] = $detail[0];
        $data['ss'] = $ss[$data['detail']['D03_SS_CD']];
        $data['address'] = $address[$data['detail']['D03_SS_CD']];
        $data['tel'] = $tel[$data['detail']['D03_SS_CD']];
        $data['detail']['D02_SYAKEN_CYCLE'] = $this->getCar([
            'D02_CUST_NO' => $data['detail']['D03_CUST_NO'],
            'D02_CAR_NO' => $data['detail']['D03_CAR_NO']
        ]);
        $data['detail']['sagyo'] = $this->getSagyo($data['detail']['D03_DEN_NO']);
        $data['detail']['product'] = $this->getProduct($data['detail']['D03_DEN_NO']);

        $data['job'] = $job;
        $data['status'] = Yii::$app->params['status'];
        $this->layout = '@app/views/layouts/print';
        return $this->render('preview', $data);
    }
}