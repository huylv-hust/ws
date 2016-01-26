<?php
$_API_URL_USAPPY = 'http://usappy.com/api/';
$_API_URL_UPS = 'http://verify-ups.com/api/';
$_API_SECRET = 'sec';
return [
        'api'=> [
            'ss' => [
                'url_ss' => $_API_URL_USAPPY.'ss',
            ],
            'car' => [
                'url_car' => $_API_URL_USAPPY.'car',
                'url_card_info' => $_API_URL_UPS.'getmembercard',
                'url_car_info' => $_API_URL_UPS.'getmembercar',
                'url_update_member_car' => $_API_URL_UPS.'updmembercar',
                'url_update_member_card' => $_API_URL_UPS.'updmembercard',
            ],
            'member' => [
                'url_card'          => $_API_URL_UPS.'getcardno',
                'url_member'        => $_API_URL_UPS.'getmemberbasic',
                'url_member_list'   => $_API_URL_UPS.'getmembers',
                'url_update_member' => $_API_URL_UPS.'updmemberbasic',
            ],
            'secret' => $_API_SECRET,
        ],
        'd02SyakenCycle' => [
            '1' => '1',
            '2' => '2',
        ],
        'd03YoyakuSagyoNo' => [
            '0' => '',
            '1' => 'タイヤ',
            '2' => 'オイル',
            '3' => 'バッテリー',
            '4' => 'コーティング',
            '5' => 'リペア',
            '6' => '車検',
            '7' => 'その他',
        ],
        'D03_TANTO_SEIｏD03_TANTO_MEI' => [

        ],
		'M05_COM_CD_TAISA' => range(42000, 42999),
        'adminEmail' => 'admin@example.com',
        'defaultPageSize' => '20',
        'message_save_error' => '保存が失敗しました。',
        'status' => [
            ''  => '指定なし',
            '0' => '受付データ',
            '1' => '予約データ',
            '2' => '作業確定',
        ],
        'timeOutLogin' => 1800,
        'zippdf' => [
            'year' => [
                '2016' => '2016',
                '2017' => '2017',
                '2018' => '2018',
                '2019' => '2019',
                '2020' => '2020',
                '2021' => '2021',
                '2022' => '2022',
                '2023' => '2023',
                '2024' => '2024',
            ],
            'month' => [
                '01' => '01',
                '02' => '02',
                '03' => '03',
                '04' => '04',
                '05' => '05',
                '06' => '06',
                '07' => '07',
                '08' => '08',
                '09' => '09',
                '10' => '10',
                '11' => '11',
                '12' => '12'
            ],
            'day' => [
                '01' => '01',
                '02' => '02',
                '03' => '03',
                '04' => '04',
                '05' => '05',
                '06' => '06',
                '07' => '07',
                '08' => '08',
                '09' => '09',
                '10' => '10',
                '11' => '11',
                '12' => '12',
                '13' => '13',
                '14' => '14',
                '15' => '15',
                '16' => '16',
                '17' => '17',
                '18' => '18',
                '19' => '19',
                '20' => '20',
                '21' => '21',
                '22' => '22',
                '23' => '23',
                '24' => '24',
                '25' => '25',
                '26' => '26',
                '27' => '27',
                '28' => '28',
                '29' => '29',
                '30' => '30',
                '31' => '31',
            ]
        ],
        'vat' => 8,
        'route_keep_cookie' => [
            'usappynumberchange/default/index',
            'usappynumberchange/default/confirm',
            'usappynumberchange/default/complete',
            'registworkslip/default/index'
    ]

];
