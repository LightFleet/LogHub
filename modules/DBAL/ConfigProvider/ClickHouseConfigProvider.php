<?php

namespace app\modules\DBAL\ConfigProvider;

class ClickHouseConfigProvider
{
    public function getConfig()
    {
        return [
            'host' => 'clickhouse',
            'port' => '8123',
            'username' => 'default',
            'password' => ''
        ];
    }
}