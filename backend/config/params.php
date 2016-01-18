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
	'adminEmail' => 'admin@example.com',
    'defaultPageSize' => '20',
	'message_save_error' => '保存が失敗しました。',
	'status' => [
            ''  => '',
            '0' => '作業予約',
            '1' => '作業確定',
        ],
];
