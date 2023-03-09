<?php

namespace app\modules\DBAL\ConfigProvider;

class ClickHouseConfigProvider
{
    public function getConfig()
    {
        return [
            'host' => getenv('CLICKHOUSE_HOST'),
            'port' => getenv('CLICKHOUSE_PORT'),
            'username' => getenv('CLICKHOUSE_USERNAME'),
            'password' => getenv('CLICKHOUSE_PASSWORD')
        ];
    }
}