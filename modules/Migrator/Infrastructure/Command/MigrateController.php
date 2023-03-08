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

//        $db->q
    }
}