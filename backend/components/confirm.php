<?php
namespace backend\components;


class confirm
{
    public static function writeconfirm($post = array())
    {

        $confirm = confirm::readconfirm(['D03_DEN_NO' => $post['D03_DEN_NO']]);
        if ($confirm['status'] == 1) {
            $post['status'] = 1;
        }
		if (isset($post['date_1']) && isset($post['date_2']) && isset($post['date_3'])) {
			$post['date'] = str_pad($post['date_1'], 4, '0', STR_PAD_LEFT).str_pad($post['date_2'], 2, '0', STR_PAD_LEFT).str_pad($post['date_3'], 2, '0', STR_PAD_LEFT);
		}

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
            'tire_1' => isset($post['tire_1']) && $post['tire_1'] ? 1 : 0,
            'tire_2' => isset($post['tire_2']) && $post['tire_2'] ? 1 : 0,
            'tire_3' => isset($post['tire_3']) && $post['tire_3'] ? 1 : 0,
            'tire_4' => isset($post['tire_4']) && $post['tire_4'] ? 1 : 0,
            'pressure_front' => isset($post['pressure_front']) ? $post['pressure_front'] : 0,
            'pressure_behind' => isset($post['pressure_behind']) ? $post['pressure_behind'] : 0,
            'rim' => isset($post['rim']) && $post['rim'] ? 1 : 0,
            'torque' => isset($post['torque']) && $post['torque'] ? 1 : 0,
            'foil' => isset($post['foil']) && $post['foil'] ? 1 : 0,
            'nut' => isset($post['nut']) && $post['nut'] ? 1 : 0,
            'oil' => isset($post['oil']) && $post['oil'] ? 1 : 0,
            'oil_cap' => isset($post['oil_cap']) && $post['oil_cap'] ? 1 : 0,
            'level' => isset($post['level']) && $post['level'] ? 1 : 0,
            'drain_bolt' => isset($post['drain_bolt']) && $post['drain_bolt'] ? 1 : 0,
            'packing' => isset($post['packing']) && $post['packing'] ? 1 : 0,
            'oil_leak' => isset($post['oil_leak']) && $post['oil_leak'] ? 1 : 0,
            'date' => isset($post['date']) ? $post['date'] : '',
            'km' => isset($post['km']) && $post['km'] ? $post['km'] : '',
            'terminal' => isset($post['terminal']) && $post['terminal'] ? 1 : 0,
            'stay' => isset($post['stay']) && $post['stay'] ? 1 : 0,
            'backup' => isset($post['backup']) && $post['backup'] ? 1 : 0,
            'startup' => isset($post['startup']) && $post['startup'] ? 1 : 0,
            'status' => isset($post['status']) && $post['status'] ? $post['status'] : 0,
        );


        $fp = fopen(getcwd() . '/data/confirm/' . $post['D03_DEN_NO'] . '.csv', 'w+');
        fputs($fp, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));
        foreach ($data as $key => $value) {
            fputcsv($fp, $value);
        }
        fclose($fp);
    }

    public static function readconfirm($post = array())
    {
        if (file_exists(getcwd() . '/data/confirm/' . $post['D03_DEN_NO'] . '.csv')) {
            $data = file_get_contents(getcwd() . '/data/confirm/' . $post['D03_DEN_NO'] . '.csv');

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

        return array(
            'tire_1' => '',
            'tire_2' => '',
            'tire_3' => '',
            'tire_4' => '',
            'pressure_front' => '',
            'pressure_behind' => '',
            'rim' => '',
            'torque' => '',
            'foil' => '',
            'nut' => '',
            'oil' => '',
            'oil_cap' => '',
            'level' => '',
            'drain_bolt' => '',
            'packing' => '',
            'oil_leak' => '',
            'date' => '',
            'km' => '',
            'terminal' =>' ',
            'stay' => '',
            'backup' => '',
            'startup' => '',
            'status' => '',
        );
    }
}