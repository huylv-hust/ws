<?php

namespace backend\modules\listworkslip\controllers;

use app\models\Sdptd01customer;
use app\models\Sdptd02car;
use app\models\Sdptd03denpyo;
use app\models\Sdptd04denpyosagyo;
use app\models\Sdptd05denpyocom;
use app\models\Sdptm01sagyo;
use app\models\Sdptm05com;
use backend\components\api;
use backend\components\confirm;
use backend\components\csv;
use backend\components\utilities;
use backend\controllers\WsController;
use Yii;
use yii\helpers\BaseUrl;

class DetailController extends WsController
{
    public function actionIndex()
    {
        $api = new api();
        $data = [];
        $filter['detail_no'] = Yii::$app->request->get('den_no');
        $obj = new Sdptd03denpyo();
        $obj_job = new Sdptm01sagyo();
        $cus = new Sdptd01customer();
        $car = new Sdptd02car();

        $job[''] = '';
        $all_job = $obj_job->getData();
        foreach ($all_job as $k => $v) {
            $job[$v['M01_SAGYO_NO']] = $v['M01_SAGYO_NAMEN'];
        }

        $detail = $obj->getDataSearch($filter);
        if (empty($detail)) {
            $this->redirect(BaseUrl::base(true) . '/list-workslip');
        }

        $data['detail'] = $detail[0];
        $data['detail']['D02_SYAKEN_CYCLE'] = $this->getCar([
            'D02_CUST_NO' => $data['detail']['D03_CUST_NO'],
            'D02_CAR_SEQ' => $data['detail']['D03_CAR_SEQ']
        ]);

        $cus_info = $cus->findOne($data['detail']['D03_CUST_NO']);
        $data['detail']['D01_UKE_TAN_NAMEN'] = $cus_info['D01_UKE_TAN_NAMEN'];
        if (isset($cus_info['D01_KAIIN_CD'])) {
            $info = $api->getMemberInfo($cus_info['D01_KAIIN_CD']);
            $data['detail']['D01_CUST_NAMEN'] = $info['member_kaiinName'];
            $data['detail']['D01_CUST_NAMEK'] = $info['member_kaiinKana'];
        }

        if ($cus_info['D01_KAIIN_CD'] != '') {
            $car_api = $api->getInfoListCar($cus_info['D01_KAIIN_CD']);

            foreach ($car_api['car_carSeq'] as $k => $v) {
                if ($v == $data['detail']['D03_CAR_SEQ']) {
                    $data['detail']['D02_SYAKEN_CYCLE'] = $car_api['car_syakenCycle'][$k];
                }
            }
        }

        $data['detail']['sagyo'] = $this->getSagyo($data['detail']['D03_DEN_NO']);
        $data['detail']['product'] = $this->getProduct($data['detail']['D03_DEN_NO']);

        $data['job'] = $job;
        $data['status'] = Yii::$app->params['status'];
        $data['check_file'] = $this->checkFile($filter['detail_no']);
        $data['check_csv'] = file_exists(getcwd() . '/data/csv/' . $filter['detail_no'] . '.csv') ? 1 : 0;

        $data['csv'] = csv::readcsv(['D03_DEN_NO' => $filter['detail_no']]);
        $data['confirm'] = confirm::readconfirm(['D03_DEN_NO' => $filter['detail_no']]);

        Yii::$app->params['titlePage'] = '作業伝票詳細';
        Yii::$app->view->title = '作業伝票詳細';
        return $this->render('index', $data);
    }

    public function getCar($filters = [])
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
        $job = [];
        foreach ($job_info as $k => $v) {
            $job[$k]['D04_SAGYO_NO'] = $v['D04_SAGYO_NO'];
        }
        return $job;
    }

    public function getProduct($den_no)
    {
        $obj = new Sdptd05denpyocom();
        $product_info = $obj->getData(['D05_DEN_NO' => $den_no]);
        $product = [];
        foreach ($product_info as $k => $v) {
            $product[$k]['D05_SURYO'] = $v['D05_SURYO'];
            $product[$k]['D05_TANKA'] = $v['D05_TANKA'];
            $product[$k]['D05_KINGAKU'] = $v['D05_KINGAKU'];
            $product[$k]['D05_COM_CD'] = $v['D05_COM_CD'];
            $product[$k]['D05_NST_CD'] = $v['D05_NST_CD'];

            $obj_sdptm05com = Sdptm05com::findOne([$v['D05_COM_CD'], $v['D05_NST_CD']]);
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
                return $this->redirect(BaseUrl::base(true) . '/list-workslip');
            }
            $status = $obj['D03_STATUS'];
            $status_update = $status == 0 ? 1 : 0;
            $obj->setData(['D03_STATUS' => $status_update], $den_no);
            if ($obj->saveData()) {
                Yii::$app->session->setFlash('success', '変更しました。');
                $url = $url = Yii::$app->session->has('url_list_workslip') ? Yii::$app->session->get('url_list_workslip') : \yii\helpers\BaseUrl::base(true) . '/list-workslip';
                return $this->redirect($url);
            }
            Yii::$app->session->setFlash('error', '変更するできません。');
            return $this->redirect(BaseUrl::base(true) . '/detail-workslip?den_no=' . $den_no);
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
                    if (file_exists(getcwd() . '/data/csv/' . $den_no . '.csv')) {
                        unlink(getcwd() . '/data/csv/' . $den_no . '.csv');
                    }
                    if (file_exists(getcwd() . '/data/confirm/' . $den_no . '.csv')) {
                        unlink(getcwd() . '/data/confirm/' . $den_no . '.csv');
                    }
                    if (file_exists(getcwd() . '/data/pdf/' . $den_no . '.pdf')) {
                        unlink(getcwd() . '/data/pdf/' . $den_no . '.pdf');
                    }
                    $url = Yii::$app->session->has('url_list_workslip') ? Yii::$app->session->get('url_list_workslip') : \yii\helpers\BaseUrl::base(true) . '/list-workslip';
                    return $this->redirect($url);
                }
            }
            Yii::$app->session->setFlash('error', '削除をできません。');
            return $this->redirect(BaseUrl::base(true) . '/detail-workslip?den_no=' . $den_no);
        }
    }


    public function actionPreview()
    {
        $branch = utilities::getAllBranch();
        $ss = $branch['all_ss'];
        $address = $branch['ss_address'];
        $tel = $branch['ss_tel'];

        $api = new api();
        $data = [];
        $filter['detail_no'] = Yii::$app->request->get('den_no');
        $cus = new Sdptd01customer();
        $obj = new Sdptd03denpyo();
        $obj_job = new Sdptm01sagyo();
        $car = new Sdptd02car();

        $job[''] = '';
        $all_job = $obj_job->getData();
        foreach ($all_job as $k => $v) {
            $job[$v['M01_SAGYO_NO']] = $v['M01_SAGYO_NAMEN'];
        }

        $detail = $obj->getDataSearch($filter);
        if (empty($detail)) {
            $this->redirect(BaseUrl::base(true) . '/list-workslip');
        }

        $data['detail'] = $detail[0];
        $data['detail']['D02_SYAKEN_CYCLE'] = $this->getCar([
            'D02_CUST_NO' => $data['detail']['D03_CUST_NO'],
            'D02_CAR_NO' => $data['detail']['D03_CAR_NO']
        ]);
//getCustomer_API
        $cus_info = $cus->findOne($data['detail']['D03_CUST_NO']);
        $data['detail']['D01_UKE_TAN_NAMEN'] = $cus_info['D01_UKE_TAN_NAMEN'];
        if (isset($cus_info['D01_KAIIN_CD'])) {
            $info = $api->getMemberInfo($cus_info['D01_KAIIN_CD']);
            $data['detail']['D01_CUST_NAMEN'] = $info['member_kaiinName'];
            $data['detail']['D01_CUST_NAMEK'] = $info['member_kaiinKana'];
        }
//getCar_API
        if ($cus_info['D01_KAIIN_CD'] != '') {
            $car_api = $api->getInfoListCar($cus_info['D01_KAIIN_CD']);

            foreach ($car_api['car_carSeq'] as $k => $v) {
                if ($v == $data['detail']['D03_CAR_SEQ']) {
                    $data['detail']['D02_SYAKEN_CYCLE'] = $car_api['car_syakenCycle'][$k];
                }
            }
        }

        $data['ss'] = isset($ss[$data['detail']['D03_SS_CD']]) ? $ss[$data['detail']['D03_SS_CD']] : '';
        $data['address'] = isset($address[$data['detail']['D03_SS_CD']]) ? $address[$data['detail']['D03_SS_CD']] : '';
        $data['tel'] = isset($tel[$data['detail']['D03_SS_CD']]) ? $tel[$data['detail']['D03_SS_CD']] : '';
        $data['detail']['sagyo'] = $this->getSagyo($data['detail']['D03_DEN_NO']);
        $data['detail']['product'] = $this->getProduct($data['detail']['D03_DEN_NO']);

        $data['job'] = $job;
        $data['status'] = Yii::$app->params['status'];

        $data['csv'] = csv::readcsv(['D03_DEN_NO' => $filter['detail_no']]);
        $data['confirm'] = confirm::readconfirm(['D03_DEN_NO' => $filter['detail_no']]);

        $this->layout = '@app/views/layouts/print';
        Yii::$app->view->title = '作業確認書';
        Yii::$app->params['titlePage'] = '作業確認書';
        return $this->render('preview', $data);
    }

    public function checkFile($den_no)
    {
        if (file_exists(getcwd() . '/data/pdf/' . $den_no . '.pdf')) {
            if (isset(confirm::readconfirm(['D03_DEN_NO' => $den_no])['status'])) {
                return confirm::readconfirm(['D03_DEN_NO' => $den_no])['status'] == 0 ? 1 : 0;
            }
            return 0;
        }
        return 0;
    }

    public function actionUpdatestatus()
    {
        $den_no = Yii::$app->request->post('den_no');
        $post = confirm::readconfirm(['D03_DEN_NO' => $den_no]);
        $post['D03_DEN_NO'] = $den_no;
        $post['status'] = Yii::$app->request->post('status');
        confirm::writeconfirm($post);
        $link = BaseUrl::base(true) . '/data/pdf/' . $den_no . '.pdf';
        return $link;
    }
}
