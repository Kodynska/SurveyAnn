<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'QPB3OUlrn1Z5jCL-EuHLAIUGzU9uSjw-',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'assetManager' => [
            'bundles' => [
                'kartik\form\ActiveFormAsset' => [
                    'bsDependencyEnabled' => false // do not load bootstrap assets for a specific asset bundle
                ],
            ],
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
//        'i18n' => [
//            'translations' => [
//                '*' => [
//                    'class' => 'yii\i18n\PhpMessageSource',
//                    'basePath' => '@app/messages', // if advanced application, set @frontend/messages
//                    'sourceLanguage' => 'en',
//                    'fileMap' => [
//                        //'main' => 'main.php',
//                    ],
//                ],
//            ],
//        ],
        'i18n' => [ 'translations' => [ 'sourceLanguage' => 'en-En',

            'polls*' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@yii/vendor/lslsoft/poll/messages',
            ],

           ],
        ],

    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
        'gridview' => [
            'class' => 'app\modules\gridview\Module',
            'downloadAction' => '/gridview/export/download',
            'i18n' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@kvgrid/messages',
                'forceTranslation' => true
            ],
        ],
        'survey' => [
            'class' => '\onmotion\survey\Module',
            'params' => [
                'bsVersion' => '4.x', // this will set globally `bsVersion` to Bootstrap 4.x for all Krajee Extensions

                'uploadsUrl' => 'http://advanced-frontend.lh/uploads/survey/', // full URL of the folder where the images will be uploaded.
                // 'uploadsUrl' => '/uploads/survey/', // or for basic
                'uploadsPath' => '@frontend/web/uploads/survey/', // absolute path to the folder where images will be saved.
            ],
//            'as access' => [
//                'class' => AccessControl::class,
//                'except' => ['default/done'],
//                'only' => ['default*'],
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'roles' => ['survey'],
//                    ],
//                ],
//            ],
        ],

    ],

    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
