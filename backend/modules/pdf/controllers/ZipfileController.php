<?php
namespace backend\modules\pdf\controllers;

use backend\components\utilities;
use Yii;
use yii\console\Controller;
use yii\helpers\BaseUrl;

class ZipfileController extends Controller
{
    /**
     * @inheritdoc
     */
    public function beforeAction()
    {
        $session = \Yii::$app->session;
        if (! $session->get('login_admin_info')) {
            Yii::$app->response->redirect(BaseUrl::base(true).'/admin/login-puncdata');
            return false;
        }

        if ($login_info = $session->get('login_admin_info') and $login_info['expired'] < time()) {
            $session->remove('login_admin_info');
            unset($session['login_admin_info']);
        }

        if ($loginInfo = $session->get('login_admin_info')) {
            $login_info['expired'] = time() + Yii::$app->params['timeOutLogin'];
            $session->set('login_admin_info', $login_info);
        }
        return true;
    }


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
     * Convert to format time
     */
    private function convertToDateFormat($string)
    {
        if (! isset($string) or ($s_length = mb_strlen(preg_replace('/\s+/', '', $string))) == 0) {
            return '';
        }
        if ($s_length == 8) {
            //20160729 => 16-Jul-29
            $string = mb_substr($string, 0, 4).'/'.mb_substr($string, 4, 2).'/'.mb_substr($string, 6, 2);
            $result = date('y-M-d', strtotime($string));
        } else if ($s_length == 11) {
            //1970年01月01日 => 70-Jan-01
            $string = mb_substr($string, 0, 4).'/'.mb_substr($string, 5, 2).'/'.mb_substr($string, 8, 2);
            $result = date('y-M-d', strtotime($string));
        } else {
            $result = $string;
        }

        return $result;
    }

    /**
     * get list array file
     * @return string
     * @author: Dang Bui
     */
    public function getListFile($start_date = '', $end_date = '', $url_source = '')
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
        return $arr_files;
    }

    /**
     * export pdf
     * @return string
     * @author: Dang Bui
     */
    public function exportPdf($start_date = null, $end_date = null, $folder_source = 'data/pdf/', $tmp_folder = '')
    {
        $zip = new \ZipArchive();
        $tmp_file = tempnam($tmp_folder, '');
        if ($zip->open($tmp_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
            die('An error occurred creating your ZIP file.');
        }
        $arr_file = $this->getListFile($start_date, $end_date, $folder_source);
        if (empty($arr_file) || ! $arr_file) {
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


    /**
     * export csv
     * @return string
     * @author: Dang Bui
     */
    public function exportCsv($start_date = null, $end_date = null, $folder_source = 'data/csv/', $tmp_folder = '')
    {
        $arr_file = $this->getListFile($start_date, $end_date, $folder_source);
        if (empty($arr_file) || ! $arr_file) {
            return false;
        }

        $csv = array();
        foreach ($arr_file as $key => $value) {
            $file = fopen($value, 'r');
            $csv[0] = fgetcsv($file);
            while (($data = fgetcsv($file)) !== false) {
                $csv[] = $data;
            }
        }

        header('Content-Type: text/csv; charset=shift-jis');
        header('Content-Disposition: attachment; filename=punc_csv_'.date('Ymd').'.csv');
        $fp = fopen('php://output', 'w');
        foreach ($csv as $k => $v) {
            $v['1'] = $this->convertToDateFormat($v['1']);
            $v['2'] = $this->convertToDateFormat($v['2']);
            $v = implode('","', $v);
            $v = mb_convert_encoding($v, 'shift-jis');
            if ($k == 0) {
                $v = str_replace('?', '', $v);
            }
            $v = explode('","', $v);
            fputcsv($fp, $v);
        }

        fclose($fp);
        return true;
    }



    public function actionIndex()
    {
        if ($data = \Yii::$app->request->post()) {
            $tmp_folder =  'data/tmp/';
            utilities::createFolder($tmp_folder);//Create folder data/zip

            $start_date = $data['start_year'].$data['start_month'].$data['start_day'];
            $end_date = $data['end_year'].$data['end_month'].$data['end_day'];
            if ($data['type-download'] == 'csv') {
                $folder_source = 'data/csv/';
                $isStatus = $this->exportCsv($start_date, $end_date, $folder_source, $tmp_folder);
                if ($isStatus) {
                    die;
                }
            } else if ($data['type-download'] == 'pdf') {
                $folder_source = 'data/pdf/';
                $isStatus = $this->exportPdf($start_date, $end_date, $folder_source, $tmp_folder);
            } else {
                \Yii::$app->params['titlePage'] = 'パンク保証データダウンロード';
                \Yii::$app->view->title = 'パンク保証データダウンロード';
                $this->layout = '@backend/views/layouts/blank';
                return $this->render('index');
            }

            if (! $isStatus) {
                Yii::$app->session->setFlash('error', 'ファイルがありません');
            } else {
                Yii::$app->session->setFlash('success', 'ＰＤＦファイルを作りました。');
            }
        }

        \Yii::$app->params['titlePage'] = 'パンク保証データダウンロード';
        \Yii::$app->view->title = 'パンク保証データダウンロード';
        $this->layout = '@backend/views/layouts/blank';
        return $this->render('index');
    }
}
