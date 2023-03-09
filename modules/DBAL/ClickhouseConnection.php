<?php

namespace app\modules\DBAL;

use app\modules\DBAL\ConfigProvider\ClickHouseConfigProvider;
use ClickHouseDB\Client;

class ClickhouseConnection
{
    private Client $client;

    public function __construct(private ClickHouseConfigProvider $clickHouseConfigProvider)
    {
        $this->client = new Client($this->clickHouseConfigProvider->getConfig());
    }

    public function getClient(): Client
    {
        return $this->client;
    }
}