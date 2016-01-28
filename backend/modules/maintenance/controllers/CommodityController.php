<?php
namespace backend\modules\maintenance\controllers;

use app\models\Sdptm05com;
use backend\controllers\WsController;
use yii\helpers\BaseUrl;
use Yii;
use backend\components\utilities;

/**
 * @author Thuanth6589 <thuanth6589@seta-asia.com.vn>
 * Class CommodityController
 * @package backend\modules\maintenance\controllers
 */
class CommodityController extends WsController
{
    public function actionIndex()
    {
        Yii::$app->params['titlePage'] = 'メンテナンス';
        Yii::$app->view->title = 'メンテナンス';
        return $this->render('index');
    }

    public function createDataExport()
    {
        $obj = new Sdptm05com();
        $product = $obj->getData(array(), 'M05_COM_CD, M05_NST_CD, M05_KIND_DM_NO, M05_COM_NAMEN, M05_LIST_PRICE');
        return $product;
    }

    /**
     * action export
     */
    public function actionExport()
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=commodity_'.date('Ymd').'.csv');
        $fp = fopen('php://output', 'w');
        fputs($fp, $bom = (chr(0xEF).chr(0xBB).chr(0xBF)));
        $obj = new Sdptm05com();
        fputcsv($fp, $obj->header);
        $data = $this->createDataExport();
        foreach ($data as $k => $v) {
            fputcsv($fp, $v);
        }

        fclose($fp);
        exit();
    }

    /**
     * action import
     * @return \yii\web\Response
     */
    public function actionImport()
    {
        $request = Yii::$app->request;
        if ($request->isPost && isset($_FILES['commodity'])) {
            $obj = new Sdptm05com();
            if (substr($_FILES['commodity']['name'], -4) == '.csv') {
                $file = utilities::convertUtf8($_FILES['commodity']['tmp_name']);
                $result = $obj->saveImport($file);
                $error = $result['error'];
            } else {
                $error[] = 'ＣＳＶのフォーマットが正しくありません';
            }

            if (empty($error) && $result['insert']) {
                Yii::$app->session->setFlash('success', 'success');
            } else {
                Yii::$app->session->setFlash('error', $error);
            }

            return $this->redirect(BaseUrl::base(true).'/update-commodity');

        }
    }
}