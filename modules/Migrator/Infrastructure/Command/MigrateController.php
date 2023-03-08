<?php

namespace app\modules\Migrator\Infrastructure\Command;

use app\modules\Migrator\Infrastructure\ConfigProvider\ClickHouseConfigProvider;
use ClickHouseDB\Client;
use yii\console\Controller;

class MigrateController extends Controller
{
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
    }

    public function actionCreateLogsTable(ClickHouseConfigProvider $clickhouseConfigProvider)
    {
        $db = new Client($clickhouseConfigProvider->getConfig());

        $db->write('
        CREATE TABLE IF NOT EXISTS nginx_access_log (
            ip String,
            dateTime DateTime,
            method String,
            url String,
            httpVersion String,
            responseCode UInt16,
            responseSize UInt64,
            referrer String,
            userAgent String
        ) ENGINE = MergeTree()
        ORDER BY dateTime;
');
    }

    public function actionDropLogsTable(ClickHouseConfigProvider $clickhouseConfigProvider)
    {
        $db = new Client($clickhouseConfigProvider->getConfig());

        $db->write('DROP TABLE IF EXISTS nginx_access_log');
    }
}