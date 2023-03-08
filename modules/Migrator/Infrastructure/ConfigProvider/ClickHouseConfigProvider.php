<?php

namespace app\modules\Migrator\Infrastructure\ConfigProvider;

class ClickHouseConfigProvider
{
    public $clickhouseConfig;

    public function getConfig()
    {
        return $this->clickhouseConfig;
    }
}