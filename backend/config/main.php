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
        ],
        'pdf' => [
            'class' => 'backend\modules\pdf\Pdf',
        ]
    ],
    'components' => [
        'request'=> [
            'enableCsrfValidation'=>false,
        ],
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
        'errorHandler' => [
           'errorAction' => 'user/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/login'       => 'user/login',
                '/operator/login' => 'user/loginadmin',
                '/timeout'   => 'user/timeout',
                '/menu'        => 'site/index',
                '/maintenance' => 'maintenance/default/index',
                '/list-staff' => 'maintenance/staff/index',
                '/regist-staff' => 'maintenance/staff/staff',
                '/edit-staff' => 'maintenance/staff/staff',
                '/update-commodity' => 'maintenance/commodity/index',
                '/regist-workslip' => 'registworkslip/default/index',
                '/detail-workslip' => 'listworkslip/detail/index',
                '/list-workslip' => 'listworkslip/default/index',
                '/usappy-number-change' => 'usappynumberchange/default/index',
                '/usappy-number-change-confirm' => 'usappynumberchange/default/confirm',
                '/usappy-number-change-complete' => 'usappynumberchange/default/complete',
                '/exportpdf' => 'usappynumberchange/default/pdf',
                '/operator/punc' => 'pdf/zipfile/index',
                '/testapi' => 'usappynumberchange/default/testapi',
                '/preview' => 'listworkslip/detail/preview',
                '/preview2' => 'registworkslip/preview/index',
            ]
        ],
    ],
    'params' => $params,
];
