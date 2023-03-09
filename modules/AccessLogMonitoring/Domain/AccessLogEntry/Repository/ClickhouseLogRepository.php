<?php

namespace app\modules\AccessLogMonitoring\Domain\AccessLogEntry\Repository;

use app\modules\AccessLogMonitoring\Domain\AccessLogEntry\Entity\AccessLogEntry;
use app\modules\DBAL\ClickhouseConnection;
use ClickHouseDB\Client;

class ClickhouseLogRepository implements ClickhouseLogRepositoryInterface
{
    private Client $client;

    public function __construct(ClickhouseConnection $clickhouseConnection)
    {
        $this->client = $clickhouseConnection->getClient();
    }

    public function save(AccessLogEntry $accessLogEntry): void
    {
        $this->client->insert(
            'nginx_access_log',
            [$accessLogEntry->toArray()],
            ['ip', 'dateTime', 'method', 'responseCode', 'responseSize', 'referrer', 'userAgent']
        );
    }
}
