<?php

namespace backend\modules\registworkslip\controllers;

use Yii;
use backend\controllers\WsController;
use backend\components\api;
use app\models\Udenpyo;
use app\models\Sdptd03denpyo;
use app\models\Sdptd01custommerseq;
use backend\modules\pdf\controllers\PdfController;
use yii\data\Pagination;
use yii\web\Cookie;

class DefaultController extends WsController
{

    public function actionIndex()
    {

        $api = new api();
        $uDenpyo = new Udenpyo();
        $login_info = Yii::$app->session->get('login_info');
        $cookie = \Yii::$app->request->cookies; // get info cus from cookie
        $cusInfo = $cookie->getValue('cus_info', ['type_redirect' => 3]);
        $custNo = (int)Yii::$app->request->get('custNo');
        $d03DenNo = Yii::$app->request->get('denpyo_no');
        $data['d03DenNo'] = $d03DenNo;
        if (Yii::$app->request->isPost) {
            $denpyoDataPost = [];
            $rs = $this->saveDataDenpyo($d03DenNo, $denpyoDataPost);
            if ($rs) {
                $this->savePdf($rs, $denpyoDataPost);
                $this->saveCsv($denpyoDataPost);
                $this->redirect(\yii\helpers\BaseUrl::base(true) . '/detail-workslip.html?den_no=' . $rs);
            } elseif ($rs === 0) {
                $data['notExitCus'] = true;
            } else {
                $data['errorEditInsert'] = true;
            }
        }

        $carDefault = $uDenpyo->setDefaultDataObj('car');
        $denpyoComDefault = $uDenpyo->setDefaultDataObj('denpyoCom');
        $denpyo = $uDenpyo->setDefaultDataObj('denpyo'); // set default data
        $tm01Sagyo = $uDenpyo->getTm01Sagyo([]); // Work job
        $data['totalDenpyoCom'] = 0;
        $listDenpyoCom = array_pad([], 10, $denpyoComDefault);
        $sagyoCheck = [];
        $data['listTm05Edit'] = [];
        $totalCarOfCus = 0;
        $data['csv'] = \backend\components\csv::readcsv(['D03_DEN_NO' => $d03DenNo]);
        if ($d03DenNo) {
            $denpyo = $uDenpyo->getDenpyo(['D03_DEN_NO' => $d03DenNo]);
            $denpyo = current($denpyo);
            $cusDb = $uDenpyo->getTd01Customer(['D01_CUST_NO' => $denpyo['D03_CUST_NO']]);
            if (count($cusDb)) {
                $cusInfo = current($cusDb);
                if (!$cusInfo['D01_KAIIN_CD']) { // get db
                    $car = $uDenpyo->getCar($cusInfo['D01_CUST_NO']);
                    $totalCarOfCus = count($car);
                    $car = array_pad($car, 5, $carDefault);
                } else { // get Api
                    $uDenpyo->getInforCarCusFromApi($uDenpyo, $api, $carDefault, $cusInfo, $totalCarOfCus, $car, false);
                }
            } else { // No exit Infor Cust
                return false;
            }

            $tm01SagyoCheck = $uDenpyo->getDenpyoSagyo(['D04_DEN_NO' => $d03DenNo]);
            if (count($tm01SagyoCheck)) {
                foreach ($tm01SagyoCheck as $tmp) {
                    $sagyoCheck[] = $tmp['D04_SAGYO_NO'];
                }
            }

            $listDenpyoCom = $uDenpyo->getDenpyoCom(['D05_DEN_NO' => $d03DenNo]);

            if (count($listDenpyoCom)) {
                $arrCdCom = [];
                foreach ($listDenpyoCom as $tmp) {
                    $arrCdCom[] = $tmp['D05_COM_CD'];
                }

                $listTm05Edit = $uDenpyo->getTm05Com(['M05_COM_CD_IN' => $arrCdCom]);
                $arrTemp = [];
                foreach ($listTm05Edit as $tmp) {
                    $arrTemp[$tmp['M05_COM_CD']] = $tmp;
                }

                $data['listTm05Edit'] = $arrTemp;
            }

            $data['totalDenpyoCom'] = count($listDenpyoCom);
            $listDenpyoCom = array_pad($listDenpyoCom, 10, $denpyoComDefault);
        } else {
            if ($cusInfo['type_redirect'] == 1) {
                $uDenpyo->getInforCarCusFromApi($uDenpyo, $api, $carDefault, $cusInfo, $totalCarOfCus, $car);
                $cusInfo['type_redirect'] = 1;
            } else {

                if ($cusInfo['type_redirect'] == 3) {
                    $cusInfo = $uDenpyo->setDefaultDataObj('customer');
                    if ($custNo) {
                        $cusDb = $uDenpyo->getTd01Customer(['D01_CUST_NO' => $custNo]);
                        $cusInfo = current($cusDb);
                    }
                    $cusInfo['type_redirect'] = 3;
                }

                $car = $uDenpyo->getCar($custNo ? $custNo : (isset($cusInfo['D01_CUST_NO']) ? $cusInfo['D01_CUST_NO'] : 0));
                $totalCarOfCus = count($car);
                $car = array_pad($car, 5, $carDefault);
            }
        }
        $cusInfo['D01_SS_CD'] = $login_info['M50_SS_CD'];
        $data['sagyoCheck'] = $sagyoCheck;
        $ssUser = ['' => ''];
        $ssUserDenpyo = ['' => ''];
        $tm08Sagyosya = $uDenpyo->getTm08Sagyosya(['M08_SS_CD' => $login_info['M50_SS_CD']]); // 277426 Is login
        if (count($tm08Sagyosya)) {
            foreach ($tm08Sagyosya as $tmp) {
                $ssUser[$tmp['M08_JYUG_CD']] = $tmp['M08_NAME_MEI'] . $tmp['M08_NAME_SEI'];
            }

            foreach ($tm08Sagyosya as $tmp) {
                $ssUserDenpyo[$tmp['M08_NAME_MEI'] . '[]' . $tmp['M08_NAME_SEI']] = $tmp['M08_NAME_MEI'] . $tmp['M08_NAME_SEI'];
            }
        }
        $data['pagination'] = new Pagination([
            'totalCount' => $uDenpyo->countDataRecord('tm05Com', []),
            'defaultPageSize' => 10, //Yii::$app->params['defaultPageSize'],
        ]);

        $data['filters']['limit'] = $data['pagination']->limit;
        $data['filters']['offset'] = $data['pagination']->offset;
        $data['tm05Com'] = $uDenpyo->getTm05Com($data['filters']);
        $data['cus'] = $cusInfo;
        $data['totalCarOfCus'] = $totalCarOfCus;
        $data['car'] = $car;
        $data['denpyo'] = $denpyo;
        $data['carSeqUse'] = $uDenpyo->getSeqCarUsed($custNo ? $custNo : $cusInfo['D01_CUST_NO']);
        $data['ssUer'] = $ssUser;
        $data['ssUerDenpyo'] = $ssUserDenpyo;
        $data['tm01Sagyo'] = $tm01Sagyo;
        $data['listDenpyoCom'] = $listDenpyoCom;
        \Yii::$app->view->title = '作業伝票作成';
        return $this->render('index', $data);
    }

    public function saveDataDenpyo($denpyoNo, &$denpyoDataPost)
    {


        $login_info = Yii::$app->session->get('login_info');
        $uDenpyo = new Udenpyo();
        $denpyo = new Sdptd03denpyo();
        $denpyoSagyo = new \app\models\Sdptd04denpyosagyo();
        $denpyoCom = new \app\models\Sdptd05denpyocom();
        $dataTemp = Yii::$app->request->post();
        foreach ($dataTemp as $key => $val) {
            if (substr($key, 0, 3) == 'D03') {
                $dataDenpyo[$key] = $val;
            }
        }

        $dataDenpyo['D03_SS_CD'] = $dataTemp['D01_SS_CD'];
        if ($dataTemp['D03_TANTO_MEI_D03_TANTO_SEI']) {
            $temTantoMeiSei = explode('[]', $dataTemp['D03_TANTO_MEI_D03_TANTO_SEI']);
            $dataDenpyo['D03_TANTO_MEI'] = $temTantoMeiSei['0'];
            $dataDenpyo['D03_TANTO_SEI'] = $temTantoMeiSei['1'];
        }

        if ($dataTemp['D03_KAKUNIN_MEI_D03_KAKUNIN_SEI']) {
            $temKakuninMeiSei = explode('[]', $dataTemp['D03_KAKUNIN_MEI_D03_KAKUNIN_SEI']);
            $dataDenpyo['D03_KAKUNIN_MEI'] = $temKakuninMeiSei['0'];
            $dataDenpyo['D03_KAKUNIN_SEI'] = $temKakuninMeiSei['1'];
        }

        unset($dataDenpyo['D03_TANTO_MEI_D03_TANTO_SEI']);
        unset($dataDenpyo['D03_KAKUNIN_MEI_D03_KAKUNIN_SEI']);
        $dataDenpyo['D03_CUST_NO'] = isset($dataTemp['D01_CUST_NO']) ? $dataTemp['D01_CUST_NO'] : 0;
        if ($denpyoNo) {
            $dataDenpyo['D03_CUST_NO'] = $dataTemp['D03_CUST_NO'];
        } else {
            $dataDenpyo['D03_DEN_NO'] = $denpyo->getSeq();
        }

        $dataDenpyo['D03_KAKUNIN'] = (int)Yii::$app->request->post('D03_KAKUNIN');
        $seqCar = Yii::$app->request->post('D02_CAR_SEQ_SELECT');
        if ($seqCar) {
            $dataDenpyo['D03_CAR_SEQ'] = $seqCar;
            $dataDenpyo['D03_CAR_NO'] = $dataTemp['D02_CAR_NO_' . $seqCar];
            $dataDenpyo['D03_CAR_ID'] = $dataTemp['D02_CAR_ID_' . $seqCar];
            $dataDenpyo['D03_METER_KM'] = $dataTemp['D02_METER_KM_' . $seqCar];
            $dataDenpyo['D03_CAR_NAMEN'] = $dataTemp['D02_CAR_NAMEN_' . $seqCar];
            $dataDenpyo['D03_HIRA'] = $dataTemp['D02_HIRA_' . $seqCar];
            $dataDenpyo['D03_JIKAI_SHAKEN_YM'] = $dataTemp['D02_JIKAI_SHAKEN_YM_' . $seqCar];
        }

        $dataDenpyoCom = [];
        $k = 1;
        for ($i = 1; $i < 11; ++$i) {
            if ($dataTemp['D05_COM_CD' . $i] != '') {
                $dataDenpyoCom[$k]['D05_DEN_NO'] = $dataDenpyo['D03_DEN_NO'];
                $dataDenpyoCom[$k]['D05_COM_CD'] = $dataTemp['D05_COM_CD' . $i];
                $dataDenpyoCom[$k]['D05_NST_CD'] = $dataTemp['D05_NST_CD' . $i];
                $dataDenpyoCom[$k]['D05_COM_SEQ'] = $k;
                $dataDenpyoCom[$k]['D05_SURYO'] = $dataTemp['D05_SURYO' . $i];
                $dataDenpyoCom[$k]['D05_TANKA'] = $dataTemp['D05_TANKA' . $i];
                $dataDenpyoCom[$k]['D05_KINGAKU'] = $dataTemp['D05_KINGAKU' . $i];
                $dataDenpyoCom[$k]['D05_INP_DATE'] = date('y-M-d');
                $dataDenpyoCom[$k]['D05_INP_USER_ID'] = $login_info['M50_USER_ID'];
                $dataDenpyoCom[$k]['D05_UPD_DATE'] = date('y-M-d');
                $dataDenpyoCom[$k]['D05_UPD_USER_ID'] = $login_info['M50_USER_ID'];
                ++$k;
            }
        }

        $m01SagyoNo = Yii::$app->request->post('M01_SAGYO_NO');
        $dataDenpySagyo = [];
        if (count($m01SagyoNo)) {
            for ($i = 0; $i < count($m01SagyoNo); ++$i)
                $dataDenpySagyo[] = [
                    'D04_DEN_NO' => $dataDenpyo['D03_DEN_NO'],
                    'D04_SAGYO_NO' => $m01SagyoNo[$i],
                    'D04_UPD_DATE' => date('d-M-y'),
                    'D04_UPD_USER_ID' => $login_info['M50_USER_ID'],
                    'D04_INP_DATE' => date('d-M-y'),
                    'D04_INP_USER_ID' => $login_info['M50_USER_ID'],
                ];

            if ($denpyoNo) {
                $listDenpyoSagyo = $denpyoSagyo->getData(['D04_DEN_NO' => $denpyoNo]);
                /* Get input date,input user id of denpyosagyo */
                if (count($listDenpyoSagyo)) {
                    foreach ($dataDenpySagyo as $index => $temp) {
                        foreach ($listDenpyoSagyo as $index1 => $temp1) {
                            if ($temp['D04_SAGYO_NO'] == $temp1['D04_SAGYO_NO']) {
                                $dataDenpySagyo[$index]['D04_INP_DATE'] = $temp1['D04_INP_DATE'];
                                $dataDenpySagyo[$index]['D04_INP_USER_ID'] = $temp1['D04_INP_USER_ID'];
                            }
                        }
                    }
                }

                /* Get input date, input user id of denpyo com */
                $listDenpyoCom = $denpyoCom->getData(['D05_DEN_NO' => $denpyoNo]);
                if (count($listDenpyoCom)) {
                    if (count($dataDenpyoCom)) {
                        foreach ($dataDenpyoCom as $index => $temp) {
                            foreach ($listDenpyoCom as $index1 => $temp1) {
                                if ($temp['D05_COM_CD'] == $temp1['D05_COM_CD'] && $temp['D05_NST_CD'] == $temp1['D05_NST_CD'] && $temp['D05_COM_SEQ'] == $temp1['D05_COM_SEQ']) {
                                    $dataDenpyoCom[$index]['D05_INP_DATE'] = $temp1['D05_INP_DATE'];
                                    $dataDenpyoCom[$index]['D05_INP_USER_ID'] = $temp1['D05_INP_USER_ID'];
                                }
                            }
                        }
                    }
                }
            }
        }

        if ($seqCar == 0 || $dataDenpyo['D03_CUST_NO'] == 0) {
            \Yii::info('Error: ' . $seqCar . $dataDenpyo['D03_CUST_NO']);
            return 0;
        }
        $dataCus['D01_SS_CD'] = $dataTemp['D01_SS_CD'];
        $dataCus['D01_UKE_JYUG_CD'] = $dataTemp['M08_NAME_MEI_M08_NAME_SEI'];
        $dataCus['D01_CUST_NO'] = $dataDenpyo['D03_CUST_NO'];
        $res = $uDenpyo->saveDenpyo($dataDenpyo, $dataDenpySagyo, $dataCus, $dataDenpyoCom, $denpyoNo);

        if ($res) {
            $denpyoDataPost = array_merge($dataTemp, $dataDenpyo);
            return $dataDenpyo['D03_DEN_NO'];
        }
        return false;
    }

    public function actionCar()
    {
        $uDenpyo = new Udenpyo();
        $carObj = new \app\models\Sdptd02car();
        $api = new api();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = \Yii::$app->request;
        $data = \Yii::$app->request->post('dataPost');
        $data = json_decode($data, true);
        $dataApi = \Yii::$app->request->post('dataCarApiField');

        if ($dataApi) { // is API
            $kaiinCd = \Yii::$app->request->post('D01_KAIIN_CD');
            $carLength = count($data);
            $dataApi = base64_decode($dataApi);
            $dataApi = json_decode($dataApi, true);
            $i = 1;
            $carApi = [];
            foreach ($data as $tmp) {
                $carApi[$i] = $uDenpyo->dbCarApi($tmp);
                $carApi[$i] = array_merge($carApi[$i], $dataApi);
                ++$i;
            }
            $rs = $api->updateCar($kaiinCd, $carLength, $carApi);
            if (count($rs)) {
                return ['result' => 1];
            }

            return ['result' => 0];
        } else { // is DB
            $denpyoNo = $request->post('D03_DEN_NO');
            $custNo = $request->post('D02_CUST_NO');
            for ($i = 0; $i < count($data); ++$i) {
                $data[$i]['D02_CAR_SEQ'] = $i + 1;
            }

            if (!$request->post('D02_CUST_NO')) { // Is guest not database
                return ['result' => -1];
            } else {

                foreach ($data as $index => $tmp) {
                    $listModelCode = $api->getListModel($tmp['D02_MAKER_CD']);
                    foreach ($listModelCode as $model) {
                        if ($model['model_code'] == $tmp['D02_MODEL_CD']) {
                            $data[$index]['D02_CAR_NAMEN'] = $model['model'];
                            break;
                        }
                    }
                }

                return $uDenpyo->updateCar($custNo, $data);
            }
        }
    }

    public function actionMaker()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $api = new api();
        $request = Yii::$app->request;
        $maker_code = $request->post('car_maker_code', '');
        $model_code = $request->post('car_model_code', '');
        $year = $request->post('car_year', '');
        $year = substr($year, 0, 4);
        $type_code = $request->post('car_type_code', '');
        $level = $request->post('level', '');
        if ($maker_code && $model_code && $year && $type_code && $level == 4) {
            $list_grade_code = $api::getListGradeCode($maker_code, $model_code, $year, $type_code);
            $list_grade = [];
            foreach ($list_grade_code as $gra) {
                $list_grade[$gra['grade_code']] = $gra['grade'];
            }

            return $list_grade;
        }

        if ($maker_code && $model_code && $year && $level == 3) {
            $list_type_code = $api::getListTypeCode($maker_code, $model_code, $year);
            $list_type = [];
            foreach ($list_type_code as $tp) {
                $list_type[$tp['type_code']] = $tp['type'];
            }
            return $list_type;
        }

        if ($maker_code && $model_code && $level == 2) {
            $list_year = $api::getListYearMonth($maker_code, $model_code);
            $option = '<option value="0">初度登録年を選択して下さい</option>';
            if (!isset($list_year['result'])) {
                $option = str_replace('<option value="0"></option>', '<option value="0">初度登録年を選択して下さい</option>', \Constants::array_to_option($list_year, 'year', 'year'));
            }

            return new \Response($option, 200, array());
        }

        if ($maker_code && $level == 1) {
            $list_model_code = $api::getListModel($maker_code);
            $list_model = [];
            foreach ($list_model_code as $mod) {
                $list_model[$mod['model_code']] = $mod['model'];
            }

            return $list_model;
        }
    }

    public function actionCus()
    {

        $api = new api();
        $uDenpyo = new Udenpyo();
        $cusObj = new \app\models\Sdptd01customer();
        $request = Yii::$app->request;
        $cookie = \Yii::$app->request->cookies;
        $infoLogin = Yii::$app->session->get('login_info');
        $cusInfo = $cookie->getValue('cus_info', ['type_redirect' => 3]);

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if ($cusInfo['type_redirect'] == 1) { // Is member
            $usappyId = $request->post('D01_KAIIN_CD');
            $dataCsApi = array(
                'member_kaiinName' => $request->post('D01_CUST_NAMEN'),
                'member_kaiinKana' => $request->post('D01_CUST_NAMEK'),
                'member_telNo1' => $request->post('D01_TEL_NO'),
                'member_telNo2' => $request->post('D01_MOBTEL_NO'),
                'member_address' => $request->post('D01_ADDR'),
            );

            $res = $api->updateMemberBasic($usappyId, $dataCsApi);
            $resDb = 1;
            $cusDb = $cusObj->getData(['D01_KAIIN_CD' => $usappyId]);
            if (count($cusDb)) {
                $dataDb = array(
                    'D01_NOTE' => $request->post('D01_NOTE'),
                    'D01_KAKE_CARD_NO' => $request->post('D01_KAKE_CARD_NO')
                );
                $cusObj->setData($dataDb, $cusDb['0']['D01_CUST_NO']);
                $resDb = (int)$cusObj->saveData();
            }
            $memberInfo = $api->getMemberInfo($usappyId);
            $memberInfo['type_redirect'] = 1;
            $cookie = new Cookie([
                'name' => 'cus_info',
                'value' => $memberInfo
            ]);
            \Yii::$app->response->cookies->add($cookie);
            return ['result_api' => (int)$res, 'result_db' => $resDb, 'custNo' => 0];
        } else { // guest insert db or update
            $data = Yii::$app->request->post();
            $cusObj->setData($data, $data['D01_CUST_NO']);
            $res = $cusObj->saveData();
            $memberInfo = $cusObj->getData(['D01_CUST_NO' => $data['D01_CUST_NO']]);
            $memberInfo['type_redirect'] = 3;
            $cookie = new Cookie([
                'name' => 'cus_info',
                'value' => $memberInfo
            ]);
            \Yii::$app->response->cookies->add($cookie);
            return ['result_db' => $res, 'result_api' => 1, 'custNo' => $data['D01_CUST_NO']];
        }
    }

    public function actionLargecom()
    {
        $m05KindComNo = Yii::$app->request->post('M05_KIND_COM_NO');
        $m05LargeComNo = Yii::$app->request->post('M05_LARGE_COM_NO');
        $uDenpyo = new Udenpyo();
        $tm03LagreCom = $uDenpyo->gettm03LagreCom(['M03_KIND_COM_NO' => $m05KindComNo, 'M03_LARGE_COM_NO' => $m05LargeComNo]);
        $tm03LagreCom = current($tm03LagreCom);
        $tm03LagreCom['M03_HOZON_KIKAN'] = mktime(0, 0, 0, date('m', time()) + $tm03LagreCom['M03_HOZON_KIKAN'], date('d', time()), date('Y', time()));
        $tm03LagreCom['M03_HOZON_KIKAN'] = date('Y年m月d日', $tm03LagreCom['M03_HOZON_KIKAN']);
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $tm03LagreCom;
    }

    public function actionSearch()
    {

        $code = \Yii::$app->request->post('code');
        $uDenpyo = new Udenpyo();
        $tm05Com = $uDenpyo->getTm05Com(['M05_COM_CD' => substr($code, 0, 6), 'M05_NST_CD' => substr($code, 6, 3)]);
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return current($tm05Com);
    }

    public function actionSs()
    {
        $ssCode = Yii::$app->request->post('ssCode');
        $uDenpyo = new Udenpyo();
        $tm08Sagyosya = $uDenpyo->getTm08Sagyosya(['M08_SS_CD' => $ssCode]);
        $ssUser['0'] = [];
        $ssUser['1'] = [];
        if (count($tm08Sagyosya)) {
            foreach ($tm08Sagyosya as $tmp) {
                $ssUser['0'][$tmp['M08_JYUG_CD']] = $tmp['M08_NAME_MEI'] . $tmp['M08_NAME_SEI'];
                $ssUser['1'][$tmp['M08_NAME_MEI'] . '[]' . $tmp['M08_NAME_SEI']] = $tmp['M08_NAME_MEI'] . $tmp['M08_NAME_SEI'];
            }
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $ssUser;
    }

    public function actionWarranty()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $uDenpyo = new Udenpyo();
        $tm09Warranty = new \app\models\Sdptm09warrantyno();
        //$login_info = Yii::$app->session->get('login_info');
        //$ssCd = $login_info['M50_SS_CD'];
        $ssCd = Yii::$app->request->post('ss_cd');
        $tm09WarrantyNo = $uDenpyo->getTm09WarrantyNo(['M09_SS_CD' => $ssCd]);
        if (count($tm09WarrantyNo) == 0) {
            $dataWarranty = [
                'M09_SS_CD' => $ssCd,
                'M09_WARRANTY_NO' => 1,
                'M09_INP_DATE' => date('d-M-y'),
                'M09_INP_USER_ID' => 'SCRADMIN',
                'M09_UPD_DATE' => date('d-M-y'),
                'M09_UPD_USER_ID' => 'SCRADMIN',
            ];

            $tm09Warranty->setData($dataWarranty);
            $tm09Warranty->saveData();
            return ['numberWarrantyNo' => $ssCd . str_pad(1, 4, '0', STR_PAD_LEFT)];
        } else {
            $dataWarranty = current($tm09WarrantyNo);
            $dataWarranty['M09_WARRANTY_NO'] = $dataWarranty['M09_WARRANTY_NO'] + 1;
            $dataWarranty['M09_UPD_DATE'] = date('d-M-y');
            $dataWarranty['M09_UPD_USER_ID'] = 'SCRADMIN';
            $tm09Warranty->setData($dataWarranty, $ssCd);
            $res = $tm09Warranty->saveData();
            return ['numberWarrantyNo' => $ssCd . str_pad($dataWarranty['M09_WARRANTY_NO'], 4, '0', STR_PAD_LEFT)];
        }
    }

    public function actionPdfview()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $postData = \Yii::$app->request->post();
        return ['file' => $this->savePdf('0', $postData, true)];
    }

    public function savePdf($denpyoNo, $postData, $isView = false)
    {

        $api = new api();
        $uDenpyo = new Udenpyo();
        if (!$isView) {
            $creat_warranty = false;
            for ($i = 1; $i < 11; ++$i) {
                if (isset($postData['warranty_check]']) && (int)$postData['D05_COM_CD' . $i] && in_array((int)$postData['D05_COM_CD' . $i], range(42000, 42999))) {
                    $creat_warranty = true;
                    break;
                }
            }

            if (!$creat_warranty) {
                return -1;
            }
        }


        $denpyo = $uDenpyo->setDefaultDataObj('denpyo');
        if ($denpyoNo) {
            $denpyo = $uDenpyo->getDenpyo(['D03_DEN_NO' => $denpyoNo]);
            $denpyo = current($denpyo);
        }

        $listSS = $api->getSsName();
        $ssInfo = [];
        foreach ($listSS as $ss) {

            if ($ss['sscode'] == $denpyo['D03_SS_CD'] || $ss['sscode'] == $postData['D03_SS_CD']) {
                $ssInfo = $ss;
                break;
            }
        }

        $info_warranty = [
            'number' => $postData['M09_WARRANTY_NO'],
            'date' => date('d-M-y'),
            'expired' => date('Y年m月d日', mktime(0, 0, 0, date('m', time()) + 6, date('d', time()), date('Y', time()))),
        ];

        $info_car = [
            'customer_name' => isset($postData['WARRANTY_CUST_NAMEN']) ? $postData['WARRANTY_CUST_NAMEN'] : '',
            'car_name' => isset($denpyo['D03_CAR_NAMEN']) ? $denpyo['D03_CAR_NAMEN'] : '',
            'car_license' => isset($postData['D03_CAR_NO']) ? $postData['D03_CAR_NO'] : '',
        ];
        $info_bill = [
            'front_wheel_right' => [
                'info_market' => $postData['right_front_manu'],
                'product_name' => $postData['right_front_product'],
                'size' => $postData['right_front_size'],
                'serial' => $postData['right_front_serial'],
            ],
            'front_wheel_left' => [
                'info_market' => $postData['left_front_manu'],
                'product_name' => $postData['left_front_manu'],
                'size' => $postData['left_front_manu'],
                'serial' => $postData['left_front_manu'],
            ],
            'back_wheel_right' => [
                'info_market' => $postData['right_behind_manu'],
                'product_name' => $postData['right_behind_product'],
                'size' => $postData['right_behind_size'],
                'serial' => $postData['right_behind_serial'],
            ],
            'back_wheel_left' => [
                'info_market' => $postData['left_behind_manu'],
                'product_name' => $postData['left_behind_product'],
                'size' => $postData['left_behind_size'],
                'serial' => $postData['left_behind_serial'],
            ],
            'otherB' => [
                'info_market' => $postData['other_b_manu'],
                'product_name' => $postData['other_b_product'],
                'size' => $postData['other_b_size'],
                'serial' => $postData['other_b_serial'],
            ],
            'otherA' => [
                'info_market' => $postData['other_a_manu'],
                'product_name' => $postData['other_a_product'],
                'size' => $postData['other_a_size'],
                'serial' => $postData['other_a_serial'],
            ]
        ];
        $info_ss = [
            'name' => isset($ssInfo['ss_name']) ? $ssInfo['ss_name'] : 'N/A',
            'address' => isset($ssInfo['address']) ? $ssInfo['address'] : 'N/A',
            'mobile' => isset($ssInfo['tel']) ? $ssInfo['tel'] : 'N/A',
        ];
        $data = [
            'info_warranty' => $info_warranty,
            'info_car' => $info_car,
            'info_bill' => $info_bill,
            'info_ss' => $info_ss
        ];

        $pdf_export = new PdfController();
        $res = $pdf_export->exportBill($info_warranty, $info_car, $info_bill, $info_ss, $denpyo['D03_DEN_NO'], $isView ? null : 'save', $isView ? 1 : 0);
        return $res;
    }

    public function saveCsv($postData)
    {

        $postData['D05_SURYO'] = 1;
        $totalTaisa = 0;
        for ($i = 1; $i < 11; ++$i) {
            if (isset($postData['warranty_check']) && (int)$postData['D05_COM_CD' . $i] && in_array((int)$postData['D05_COM_CD' . $i], range(42000, 42999))) {
                $totalTaisa = $totalTaisa + 1;
            }
        }

        if ($totalTaisa) {
            $postData['D05_SURYO'] = $totalTaisa;
            return \backend\components\csv::writecsv($postData);
        }

        return true;
    }

}
