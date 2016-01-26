<?php
namespace backend\modules\pdf\controllers;

use backend\components\utilities;
use backend\controllers\WsController;
use Yii;

class ZipfileController extends WsController
{
    private function equal3Time($time_file, $start_time = null, $end_time = null)
    {
        $time_file = intval($time_file);
        $start_time = intval($start_time);
        $end_time = intval($end_time);
        if (($time_file <= $end_time) && ($time_file >= $start_time)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * get list array file
     * @return string
     * @author: Dang Bui
     */
    public function getListFile($start_date = null, $end_date = null, $url_source = '', $tmp_folder = '')
    {
        if (! isset($start_date) ||! isset($end_date)) {
            return false;
        }
        //Check folder exits
        if (! is_dir($url_source)) {
            return false;
        }
        $arr_files = array();
        $list_files = scandir($url_source);
        $list_files = array_diff($list_files, array('.','..'));
        //Check file exits in folder
        if (empty($list_files)) {
            return false;
        }

        foreach ($list_files as $k => $v) {
            $create_time_file = date("Ymd", filectime($url_source.$v));
            if ($this->equal3Time($create_time_file, $start_date, $end_date)) {
                $arr_files[] = $url_source.$v;
            }
        }
        return $this->zipListFile($arr_files, $tmp_folder);
    }

    public function zipListFile($arr_file = array(), $tmp_folder = 'data/tmp/')
    {
        $zip = new \ZipArchive();
        $tmp_file = tempnam($tmp_folder, '');
        if ($zip->open($tmp_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
            die('An error occurred creating your ZIP file.');
        }
        if (empty($arr_file)) {
            return false;
        }
        //Add file in zip
        foreach ($arr_file as $k => $v) {
            $zip->addFile($v);
        }
        $zip->close();
        header('Content-disposition: attachment; filename=Article.zip');
        header('Content-type: application/zip');
        readfile($tmp_file);
        unlink($tmp_file);
        return true;
    }

    public function actionIndex()
    {
        if ($data = \Yii::$app->request->get()) {
            $start_date = $data['start_year'].$data['start_month'].$data['start_day'];
            $end_date = $data['end_year'].$data['end_month'].$data['end_day'];
            if ($data['type-download'] == 'csv') {
                $folder_source = 'data/csv/';
            } else if ($data['type-download'] == 'pdf') {
                $folder_source = 'data/pdf/';
            } else {
                \Yii::$app->params['titlePage'] = 'パンク保証データダウンロード';
                \Yii::$app->view->title = 'パンク保証データダウンロード';
                $this->layout = '@backend/views/layouts/blank';
                return $this->render('index');
            }
            $tmp_folder =  'data/tmp/';

            utilities::createFolder($tmp_folder);//Create folder data/zip

            $isStatus = $this->getListFile($start_date, $end_date, $folder_source, $tmp_folder);
            if (! $isStatus) {
                Yii::$app->session->setFlash('error', 'File not found');
            } else {
                Yii::$app->session->setFlash('success', 'Create file pdf success');
            }
        }

        \Yii::$app->params['titlePage'] = 'パンク保証データダウンロード';
        \Yii::$app->view->title = 'パンク保証データダウンロード';
        $this->layout = '@backend/views/layouts/blank';
        return $this->render('index');
    }
}
