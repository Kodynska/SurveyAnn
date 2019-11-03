<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,

    'controllerMap' => [
        'migrate-lslsoft-create' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => 'vendor/lslsoft/yii2-poll/migrations/create',
            'migrationTable' => 'migration_lslsoft_create',
        ],
        'migrate-lslsoft-insert' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => 'vendor/lslsoft/yii2-poll/migrations/insert',
            'migrationTable' => 'migration_lslsoft_insert',
        ],
    ],



];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
