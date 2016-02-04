<?php
namespace backend\components;

class utilities
{
    public static function getAllBranch()
    {
        $api = new api();
        $ss = $api->getSsName();
        $all_branch = array();
        $all_ss = array();
        $ss_address = array();
        $ss_tel = array();
        foreach ($ss as $k => $v) {
            $all_branch[$v['branch_code']] = $v['branch_name'];
            $all_ss[$v['sscode']] = $v['ss_name'];
            $all_ss_branch[$v['sscode']] = $v['branch_code'];
            $all_branch_ss[$v['branch_code']][] = $v['sscode'];
            $ss_address[$v['sscode']] = $v['address'];
            $ss_tel[$v['sscode']] = $v['tel'];
        }

        return [
            'all_ss' => $all_ss,
            'all_branch' => \Yii::$app->params['branch'],
            'all_branch_ss' => $all_branch_ss,
            'all_ss_branch' => $all_ss_branch,
            'ss_address' => $ss_address,
            'ss_tel' => $ss_tel,
        ];
    }

    public static function convertUtf8($file)
    {
        $data = file_get_contents($file);
        if (mb_detect_encoding($data, 'UTF-8', true) === false) {
            $encode_ary = array(
                'ASCII',
                'JIS',
                'eucjp-win',
                'sjis-win',
                'EUC-JP',
                'UTF-8',
            );
            $data = mb_convert_encoding($data, 'UTF-8', $encode_ary);
        }

        $fp = tmpfile();
        fwrite($fp, $data);
        rewind($fp);
        return $fp;
    }

    public static function convertSJIS($file)
    {
        $data = file_get_contents($file);
        if (mb_detect_encoding($data, 'SJIS', true) === false) {
            $encode_ary = array(
                'ASCII',
                'JIS',
                'eucjp-win',
                'sjis-win',
                'EUC-JP',
                'UTF-8',
            );
            $data = mb_convert_encoding($data, 'SJIS', $encode_ary);
        }

        $fp = tmpfile();
        fwrite($fp, $data);
        rewind($fp);
        return $fp;
    }


    /**
     * @inheritdoc
     * delete cookie
     * @author: dangbc6591
     */
    public static function deleteCookie($namecookie)
    {
        $cookies = \Yii::$app->response->cookies;
        $cookies->remove($namecookie);
        unset($cookies[$namecookie]);
    }

    /**
     * Create folder in server if folder not exist
     */
    public static function createFolder($path)
    {
        $string_path = explode('/', $path);
        $string = '';
        foreach ($string_path as $k => $v) {
            $string = $string . '/' . $v;
            $string = trim($string, '/');
            if (!is_dir($string)) {
                mkdir($string);
            }
        }
    }
}