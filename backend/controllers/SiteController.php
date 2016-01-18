<?php
namespace backend\controllers;

use app\models\Sdptd01customer;
use backend\components\api;
use backend\components\utilities;
use Yii;
use yii\web\Cookie;

/**
 * Site controller
 */
class SiteController extends WsController
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        utilities::deleteCookie('cus_info');//Delete coolkie cus_info
        \Yii::$app->view->title = 'SSサポートサイトTOP';
        return $this->render('index');
    }

    /**
     * @inheritdoc
     * equal two array
     * @author: dangbc6591
     */
    private function equalArray($arr1 = array(), $arr2 = array())
    {
        if (empty($arr1)) {
            return false;
        }
        if (isset($arr1['member_tel'])) {
            if ($arr1['member_tel'] != $arr2['member_telNo1'] && $arr1['member_tel'] != $arr2['member_telNo2']) {
                return false;
            }
            unset($arr1['member_tel']);
        }
        if (isset($arr1['license_plates'])) {
            unset($arr1['license_plates']);
        }

        foreach ($arr1 as $k => $v) {
            if ($arr1[$k] != $arr2[$k]) {
                return false;
            }
        }
        return true;
    }

    /**
     * @inheritdoc
     * equal no car
     * @author: dangbc6591
     */
    private function equalNocar($nocar, $arrnocar = array())
    {
        foreach ($arrnocar as $k => $v) {
            if ($nocar == $arrnocar[$k]) {
                return true;
            }
        }
        return false;
    }

    /**
     * @inheritdoc
     * check member usappy info
     * @author: dangbc6591
     */
    public function actionCheckmember()
    {
        utilities::deleteCookie('cus_info');//Delete coolkie cus_info
        $api = new api();
        $flag = false;
        $flag1 = false;
        $flag2 = true;
        $array_source = array();
        //Get data post
        $url_redirect = Yii::$app->request->post('url_redirect');
        $type_redirect = Yii::$app->request->post('type_redirect');

        $member_card = Yii::$app->request->post('card_number', '');
        $member_birthday = Yii::$app->request->post('member_birthday', '');
        $member_kaiinKana = Yii::$app->request->post('member_kaiinKana', '');
        $member_tel = Yii::$app->request->post('member_tel', '');
        $license_plates = Yii::$app->request->post('license_plates', '');

        if ($member_birthday != '') {
            $array_source['member_birthday'] = $member_birthday;
        }
        if ($member_kaiinKana != '') {
            $array_source['member_kaiinKana'] = $member_kaiinKana;
        }
        if ($member_tel != '') {
            $array_source['member_tel'] = $member_tel;
        }
        if ($license_plates != '') {
            $array_source['license_plates'] = $license_plates;
        }
        $member_info = $api->getMemberInfo($member_card);
        $member_info['type_redirect'] = $type_redirect;

        if (! isset($member_info['member_kaiinCd'])) {
            $flag = false;
        } else {
            $flag1 = $this->equalArray($array_source, $member_info);
            if ($license_plates != '') {
                $list_info_car = $api->getInfoListCar($member_card);
                $car_carNo = $list_info_car['car_carNo'];
                $flag2 = $this->equalNocar($license_plates, $car_carNo);
            }
        }
        if ($flag1 == true && $flag2 == true) {
            $flag = true;
            $cookie = new Cookie([
                'name' => 'cus_info',
                'value' => $member_info
            ]);
            \Yii::$app->response->cookies->add($cookie);
            $this->redirect($url_redirect);
        }
        print_r(json_encode($flag));
    }

    /**
     * @inheritdoc
     * check  card info
     * @author: dangbc6591
     */
    public function actionCheckcard()
    {
        utilities::deleteCookie('cus_info');//Delete coolkie cus_info
        $flag = false;
        //Get data post
        $url_redirect = Yii::$app->request->post('url_redirect');
        $type_redirect = Yii::$app->request->post('type_redirect');
        $member_card = Yii::$app->request->post('card_number');
        $customer = new Sdptd01customer();
        $member_info = $customer->getData(['D01_KAKE_CARD_NO' => $member_card]);
        if (count($member_info) == 1) {
            $member_info = $member_info[0];
            $member_info['type_redirect'] = $type_redirect;
            $cookie = new Cookie([
                'name' => 'cus_info',
                'value' => $member_info
            ]);
            \Yii::$app->getResponse()->getCookies()->add($cookie);
            $this->redirect($url_redirect);
        }
        print_r(json_encode($flag));
    }
    /**
     * @inheritdoc
     * check other
     * @author: dangbc6591
     */
    public function actionCheckother()
    {
        utilities::deleteCookie('cus_info');//Delete coolkie cus_info
        $member_info = array();
        $url_redirect = Yii::$app->request->post('url_redirect');
        $type_redirect = Yii::$app->request->post('type_redirect');
        $member_info['type_redirect'] = $type_redirect;
        $cookie = new Cookie([
            'name' => 'cus_info',
            'value' => $member_info
        ]);
        \Yii::$app->getResponse()->getCookies()->add($cookie);
        $this->redirect($url_redirect);
    }
}
