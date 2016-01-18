<?php
namespace backend\modules\maintenance\controllers;

use app\models\Sdptm05com;
use yii\helpers\BaseUrl;
use yii\web\Controller;
use Yii;
use backend\components\Utilities;

class CommodityController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function createDataExport()
    {
        $obj = new Sdptm05com();
        $data[] = array_keys($obj->attributeLabels());
        $obj = new Sdptm05com();
        $product = $obj->getData();
        $data = $data + $product;
        return $data;
    }

    public function actionExport()
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=commodity_'.date('Ymd').'.csv');
        $fp = fopen('php://output', 'w');
        fputs($fp, $bom = (chr(0xEF).chr(0xBB).chr(0xBF)));
        $data = $this->createDataExport();
        foreach ($data as $k => $v) {
            fputcsv($fp, $v);
        }

        fclose($fp);
        exit();
    }

    public function actionImport()
    {
        $request = Yii::$app->request;
        if ($request->isPost && isset($_FILES['commodity'])) {
            $obj = new Sdptm05com();
            if (substr($_FILES['commodity']['name'], -4) == '.csv') {
                $file = Utilities::convertUtf8($_FILES['commodity']['tmp_name']);
                $result = $obj->saveImport($file);
                $error = $result['error'];
            } else {
                $error[] = 'ＣＳＶのフォーマットが正しくありません';
            }

            if (empty($error)) {
                Yii::$app->session->setFlash('success', 'success');
            } else {
                Yii::$app->session->setFlash('error', $error);
            }

            return $this->redirect(BaseUrl::base(true).'/update-commodity.html');
        }
    }
}