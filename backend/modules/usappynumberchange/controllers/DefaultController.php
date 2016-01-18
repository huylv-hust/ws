<?php

namespace backend\modules\usappynumberchange\controllers;

use backend\components\api;
use backend\components\utilities;
use backend\controllers\WsController;
use kartik\mpdf\Pdf;
use yii\helpers\BaseUrl;

class DefaultController extends WsController
{
    /**
     * @return string|\yii\web\Response
     * check car number in card_cardBangou
     */
    private function equalCardNumber($oldcardnumber, $newcardnumber, $arrcardnumber)
    {
        foreach ($arrcardnumber as $k => $v) {
            if ($oldcardnumber == $arrcardnumber[$k]) {
                $arrcardnumber[$k] = $newcardnumber;
                return $arrcardnumber;
            }
        }
        return false;
    }

    /*
     *index change member car
     * @author: Dang Bui
     * */
    public function actionIndex()
    {
        $cookie = \Yii::$app->request->cookies;
        $cus_info = $cookie->getValue('cus_info', '0');
        if ($cus_info == 0) {
            return $this->goHome();
        }
        $data['cus_info'] = $cus_info;
        \Yii::$app->view->title = 'Usappyカード変更';
        return $this->render('index', $data);
    }

    /*
     *confirm change member car
     * @author: Dang Bui
     * */
    public function actionConfirm()
    {
        $cookie = \Yii::$app->request->cookies;
        $cus_info = $cookie->getValue('cus_info', '0');
        $api = new api();
        if (! $data = \Yii::$app->request->post()) {
            return $this->redirect(BaseUrl::base(true).'/usappy-number-change.html');
        }
        $info_card = $api->getInfoListCard($cus_info['member_kaiinCd']);
        //card_cardBangou
        if (! $card_cardBangou = $this->equalCardNumber($data['oldCardNumber'], $data['newCardNumber'], $info_card['card_cardBangou'])) {
            \Yii::$app->session->setFlash('error', '旧Usappyカード番号が登録されていません');
            $data['cus_info'] = $cus_info;
            return $this->render('index', $data);
        }
        $info_card['card_cardBangou'] = $card_cardBangou;
        $info_card = json_encode($info_card);

        $form['data'] = [
            'infoCard'   => $info_card,
            'kaiinCd' => $cus_info['member_kaiinCd'],
            'memberKaiinName' => $cus_info['member_kaiinName'],
            'oldCardNumber' => $data['oldCardNumber'],
            'newCardNumber' => $data['newCardNumber']
        ];
        \Yii::$app->view->title = 'Usappyカード変更';
        return $this->render('confirm', $form);
    }
    /**
     *complete change member car
     * @author: Dang Bui
     */
    public function actionComplete()
    {
        if (! $data = \Yii::$app->request->post()) {
            return $this->redirect(BaseUrl::base(true).'/usappy-number-change.html');
        }
        $memberKaiinName = $data['memberKaiinName'];
        $infoCard = json_decode($data['infoCard'], true);
        $oldCardNumber = $data['oldCardNumber'];
        $newCardNumber = $data['newCardNumber'];
        $kaiinCd = $data['kaiinCd'];
        $api = new api();

        $status = $api->updateCardNumber($kaiinCd, $infoCard);
        if ($status) {
            \Yii::$app->session->setFlash('info', '下記の内容でUsappyカード番号を変更しました。');
        } else {
            \Yii::$app->session->setFlash('info', 'Error Update Card Number');
        }
        utilities::deleteCookie('cus_info');//Delete coolkie cus_info
        $form['data'] = [
            'memberKaiinName' => $memberKaiinName,
            'oldCardNumber' => $oldCardNumber,
            'newCardNumber' => $newCardNumber
        ];

        \Yii::$app->view->title = 'Usappyカード変更';
        return $this->render('complete', $form);

    }

    /**
     * test api
     * @author: Dang Bui
     */
    public function actionTestapi()
    {
        $api = new api();
        $member_info = $api->getMemberInfo('282704000162');
        $infocar = $api->getInfoListCar('282704000162');
        $infocard = $api->getInfoListCard('282704000162');
        echo '<pre>';
        var_dump($member_info);
        var_dump($infocar);
        var_dump($infocard);
        echo '</pre>';
        die;
    }
    /**
     *export pdf
     * @author: Dang Bui
     */
    public function actionPdf()
    {
        $stringTarget = $this->renderPartial('pdf');
//        $pdf = new \mPDF('ja+aCJK');
        $pdf = new \mPDF('utf-8');
        $pdf->WriteHTML($stringTarget);
        $pdf->Output();
        exit;
    }
}
