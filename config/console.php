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
        'clickhouseConfigProvider' => \app\modules\DBAL\ConfigProvider\ClickHouseConfigProvider::class,
        'clickhouseConnection' => \app\modules\DBAL\ClickhouseConnection::class,
        'accessLogParser' => \app\modules\AccessLogMonitoring\Infrastructure\AccessLogParser\NginxAccessLogParser::class,
        'clickHouseLogRepository' => \app\modules\AccessLogMonitoring\Domain\AccessLogEntry\Repository\ClickhouseLogRepository::class,

        'logMonitor' => \app\modules\AccessLogMonitoring\Usecase\Service\LogMonitor::class,
        'logQuery' => \app\modules\AccessLogMonitoring\Usecase\Service\LogQuery::class
    ],
    'params' => $params,
    'controllerMap' => [
        'clickhouse-migrate' => \app\modules\Migrator\Infrastructure\Command\MigrateController::class,
        'access-log-monitoring' => \app\modules\AccessLogMonitoring\Command\AccessLogMonitoringController::class,
        'access-log-query' => \app\modules\AccessLogMonitoring\Command\AccessLogQueryController::class
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
    // configuration adjustments for 'dev' environment
    // requires version `2.1.21` of yii2-debug module
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
