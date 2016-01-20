<?php
/**
 * Created by PhpStorm.
 * User: huylv
 * Date: 1/20/2016
 * Time: 9:23 AM
 */

namespace backend\components;


use yii\helpers\BaseUrl;

class csv
{
    private function getLink()
    {
        return BaseUrl::base(true);
    }

    public function writecsv($post = array())
    {
        $branch = utilities::getAllBranch();
        $branch_code = isset($branch['all_ss_branch'][$post['D01_SS_CD']]) ? $branch['all_ss_branch'][$post['D01_SS_CD']] : '';
        $branch_name = isset($branch['all_branch'][$branch_code]) ? $branch['all_branch'][$branch_code] : '';
        $ss_name = isset($branch['all_ss'][$post['D01_SS_CD']]) ? $branch['all_ss'][$post['D01_SS_CD']] : '';

        $data[0] = array(
            '保証書番号',
            '保証期間',
            '購入日',
            '購入本数',
            '顧客名',
            'フリガナ',
            '郵便番号',
            '住所',
            '電話番号',
            '車名',
            '車番',
            '右前メーカー',
            '右前商品名',
            '右前サイズ',
            '右前セリアル',
            '右前本数',
            '左前メーカー',
            '左前商品名',
            '左前サイズ',
            '左前セリアル',
            '左前本数',
            '右後メーカー',
            '右後商品名',
            '右後サイズ',
            '右後セリアル',
            '右後本数',
            '左後メーカー',
            '左後商品名',
            '左後サイズ',
            '左後セリアル',
            '左後本数',
            'その他Ａメーカー',
            'その他Ａ商品名',
            'その他Ａサイズ',
            'その他Ａセリアル',
            'その他Ａ本数',
            'その他Ｂメーカー',
            'その他Ｂ商品名',
            'その他Ｂサイズ',
            'その他Ｂセリアル',
            'その他Ｂ本数',
            'POS伝票番号',
            '支店コード',
            '支店名',
            'SSコード',
            'SS名',
            '作業伝票番号',
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
            'warranty_card_number' => $post['warranty_card_number'],
            'warranty_period' => $post['warranty_period'],
            'purchase_date' => $post['purchase_date'],
            'purchase_no' => $post['purchase_no'],
            'D01_CUST_NAMEN' => $post['D01_CUST_NAMEN'],
            'D01_CUST_NAMEK' => $post['D01_CUST_NAMEK'],
            'D01_YUBIN_BANGO' => $post['D01_YUBIN_BANGO'],
            'D01_ADDR' => $post['D01_ADDR'],
            'D01_TEL_NO' => $post['D01_TEL_NO'],
            'D02_MODEL_CD' => $post['D02_MODEL_CD'],
            'D02_CAR_NO' => $post['D02_CAR_NO'],
            'right_front_manu' => $post['right_front_manu'],
            'right_front_product' => $post['right_front_product'],
            'right_front_size' => $post['right_front_size'],
            'right_front_serial' => $post['right_front_serial'],
            'right_front_no' => $post['right_front_no'],
            'left_front_manu' => $post['left_front_manu'],
            'left_front_product' => $post['left_front_product'],
            'left_front_size' => $post['left_front_size'],
            'left_front_serial' => $post['left_front_serial'],
            'left_front_no' => $post['left_front_no'],
            'right_behind_manu' => $post['right_behind_manu'],
            'right_behind_product' => $post['right_behind_product'],
            'right_behind_size' => $post['right_behind_size'],
            'right_behind_serial' => $post['right_behind_serial'],
            'right_behind_no' => $post['right_behind_no'],
            'left_behind_manu' => $post['left_behind_manu'],
            'left_behind_product' => $post['left_behind_product'],
            'left_behind_size' => $post['left_behind_size'],
            'left_behind_serial' => $post['left_behind_serial'],
            'left_behind_no' => $post['left_behind_no'],
            'other_a_manu' => $post['other_a_manu'],
            'other_a_prduct' => $post['other_a_prduct'],
            'other_a_size' => $post['other_a_size'],
            'other_a_serial' => $post['other_a_serial'],
            'other_a_no' => $post['other_a_no'],
            'other_b_manu' => $post['other_b_manu'],
            'other_b_prduct' => $post['other_b_prduct'],
            'other_b_size' => $post['other_b_size'],
            'other_b_serial' => $post['other_b_serial'],
            'other_b_no' => $post['other_b_no'],
            'D03_POS_DEN_NO' => $post['D03_POS_DEN_NO'],
            'branch_code' => $branch_code,
            'branch_name' => $branch_name,
            'ss_name' => $ss_name,
            'D01_SS_CD' => $post['D01_SS_CD'],
            'D03_DEN_NO' => $post['D03_DEN_NO'],
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
            'status' => $post['status'],
        );

        $fp = fopen($this->getLink() . '\\data\\csv\\' . $post['D03_DEN_NO'] . '.csv', 'w+');
        fputs($fp, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));
        foreach ($data as $key => $value) {
            fputcsv($fp, $value);
        }
        fclose($fp);
        exit();
    }

    public function readcsv($post = array())
    {
        $data = file_get_contents($this->getLink() . '\\data\\csv\\' . $post['D03_DEN_NO'] . '.csv');

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
            'warranty_card_number' => $data['0'],
            'warranty_period' => $data['1'],
            'purchase_date' => $data['2'],
            'purchase_no' => $data['3'],
            'D01_CUST_NAMEN' => $data['4'],
            'D01_CUST_NAMEK' => $data['5'],
            'D01_YUBIN_BANGO' => $data['6'],
            'D01_ADDR' => $data['7'],
            'D01_TEL_NO' => $data['8'],
            'D02_MODEL_CD' => $data['9'],
            'D02_CAR_NO' => $data['10'],
            'right_front_manu' => $data['11'],
            'right_front_product' => $data['12'],
            'right_front_size' => $data['13'],
            'right_front_serial' => $data['14'],
            'right_front_no' => $data['15'],
            'left_front_manu' => $data['16'],
            'left_front_product' => $data['17'],
            'left_front_size' => $data['18'],
            'left_front_serial' => $data['19'],
            'left_front_no' => $data['20'],
            'right_behind_manu' => $data['21'],
            'right_behind_product' => $data['22'],
            'right_behind_size' => $data['23'],
            'right_behind_serial' => $data['24'],
            'right_behind_no' => $data['25'],
            'left_behind_manu' => $data['26'],
            'left_behind_product' => $data['27'],
            'left_behind_size' => $data['28'],
            'left_behind_serial' => $data['29'],
            'left_behind_no' => $data['30'],
            'other_a_manu' => $data['31'],
            'other_a_prduct' => $data['32'],
            'other_a_size' => $data['33'],
            'other_a_serial' => $data['34'],
            'other_a_no' => $data['35'],
            'other_b_manu' => $data['36'],
            'other_b_prduct' => $data['37'],
            'other_b_size' => $data['38'],
            'other_b_serial' => $data['39'],
            'other_b_no' => $data['40'],
            'D03_POS_DEN_NO' => $data['41'],
            'branch_code' => $data['42'],
            'branch_name' => $data['43'],
            'ss_name' => $data['44'],
            'D01_SS_CD' => $data['45'],
            'D03_DEN_NO' => $data['46'],
            'tire_1' => $data['47'],
            'tire_2' => $data['48'],
            'tire_3' => $data['49'],
            'tire_4' => $data['50'],
            'pressure_front' => $data['51'],
            'pressure_behind' => $data['52'],
            'rim' => $data['53'],
            'torque' => $data['54'],
            'foil' => $data['55'],
            'nut' => $data['56'],
            'oil' => $data['57'],
            'oil_cap' => $data['58'],
            'level' => $data['59'],
            'drain_bolt' => $data['60'],
            'packing' => $data['61'],
            'oil_leak' => $data['62'],
            'date' => $data['63'],
            'km' => $data['64'],
            'terminal' => $data['65'],
            'stay' => $data['66'],
            'backup' => $data['63'],
            'startup' => $data['68'],
            'status' => $post['69'],
        );
        
        return $result;
    }
}