<?php
/**
 * Created by PhpStorm.
 * User: levan_000
 * Date: 1/21/2016
 * Time: 11:20 AM
 */

namespace backend\components;


class confirm
{
    public static function writeconfirm($post = array())
    {
        $data[0] = array(
            'タイヤ交換図1',
            'タイヤ交換図2',
            'タイヤ交換図3',
            'タイヤ交換図4',
            '空気圧_前',
            '空気圧_後',
            'リムバルブ',
            'トルクレンチ',
            'ホイルキャップ',
            '持帰ナット',
            'オイル量',
            'オイルキャップ',
            'レベルゲージ',
            'ドレンボルト',
            'パッキン',
            'オイル漏れ',
            '次回交換目安_date',
            '次回交換目安_km',
            'ターミナル締付',
            'ステー取付',
            'バックアップ',
            'スタートアップ',
            'status',
        );

        $data[1] = array(
            'tire_1' => $post['tire_1'],
            'tire_2' => $post['tire_2'],
            'tire_3' => $post['tire_3'],
            'tire_4' => $post['tire_4'],
            'pressure_front' => $post['pressure_front'],
            'pressure_behind' => $post['pressure_behind'],
            'rim' => $post['rim'],
            'torque' => $post['torque'],
            'foil' => $post['foil'],
            'nut' => $post['nut'],
            'oil' => $post['oil'],
            'oil_cap' => $post['oil_cap'],
            'level' => $post['level'],
            'drain_bolt' => $post['drain_bolt'],
            'packing' => $post['packing'],
            'oil_leak' => $post['oil_leak'],
            'date' => $post['date'],
            'km' => $post['km'],
            'terminal' => $post['terminal'],
            'stay' => $post['stay'],
            'backup' => $post['backup'],
            'startup' => $post['startup'],
            'status' => isset($post['status']) ? $post['status'] : '0',
        );

        $fp = fopen(getcwd() . '/data/confirm/' . $post['D03_DEN_NO'] . '.csv', 'w+');
        fputs($fp, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));
        foreach ($data as $key => $value) {
            fputcsv($fp, $value);
        }
        fclose($fp);
        exit();
    }

    public static function readconfirm($post = array())
    {
        if (file_exists(getcwd() . '/data/confirm/' . $post['D03_DEN_NO'] . '.csv')) {
            $data = file_get_contents(getcwd().'/data/confirm/' . $post['D03_DEN_NO'] . '.csv');

            if (substr($data, 0, 3) == "\xEF\xBB\xBF") {
                $data = substr($data, 3);
            }

            if (mb_detect_encoding($data, "UTF-8", true) === false) {
                $encode_ary = array("ASCII", "JIS", "eucjp-win", "sjis-win", "EUC-JP", "UTF-8");
                $data = mb_convert_encoding($data, 'UTF-8', $encode_ary);
            }

            $fp = tmpfile();
            fwrite($fp, $data);
            rewind($fp);

            $title = fgetcsv($fp);
            $data = fgetcsv($fp);
            $result = array(
                'tire_1' => $data['0'],
                'tire_2' => $data['1'],
                'tire_3' => $data['2'],
                'tire_4' => $data['3'],
                'pressure_front' => $data['4'],
                'pressure_behind' => $data['5'],
                'rim' => $data['6'],
                'torque' => $data['7'],
                'foil' => $data['8'],
                'nut' => $data['9'],
                'oil' => $data['10'],
                'oil_cap' => $data['11'],
                'level' => $data['12'],
                'drain_bolt' => $data['13'],
                'packing' => $data['14'],
                'oil_leak' => $data['15'],
                'date' => $data['16'],
                'km' => $data['17'],
                'terminal' => $data['18'],
                'stay' => $data['19'],
                'backup' => $data['20'],
                'startup' => $data['21'],
                'status' => $data['22'],
            );
            return $result;
        }
    }
}