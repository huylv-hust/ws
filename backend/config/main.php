<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'maintenance' => [
            'class' => 'backend\modules\maintenance\Maintenance',
        ],
        'registworkslip' => [
            'class' => 'backend\modules\registworkslip\RegistWorkslip',
        ],
        'listworkslip' => [
            'class' => 'backend\modules\listworkslip\ListWorkslip',
        ],
        'usappynumberchange' => [
            'class' => 'backend\modules\usappynumberchange\UsappyNumberChange',
        ]
    ],
    'components' => [
        'request'=>array(
            'enableCsrfValidation'=>false,
        ),
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
//        'errorHandler' => [
//            'errorAction' => 'site/error',
//        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/login.html'       => 'user/login',
                '/menu.html'        => 'site/index',
                '/maintenance.html' => 'maintenance/default/index',
                '/list-staff.html' => 'maintenance/staff/index',
                '/regist-staff.html' => 'maintenance/staff/staff',
                '/edit-staff.html' => 'maintenance/staff/staff',
                '/update-commodity.html' => 'maintenance/commodity/index',
                '/regist-workslip.html' => 'registworkslip/default/index',
                '/detail-workslip.html' => 'listworkslip/detail/index',
                '/list-workslip.html' => 'listworkslip/default/index',
                '/usappy-number-change.html' => 'usappynumberchange/default/index',
                '/usappy-number-change-confirm.html' => 'usappynumberchange/default/confirm',
                '/usappy-number-change-complete.html' => 'usappynumberchange/default/complete',
                '/preview.html' => 'listworkslip/detail/preview'
            ]
        ],
    ],
    'params' => $params,
];
