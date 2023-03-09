<?php

namespace app\modules\AccessLogMonitoring\Domain\AccessLogEntry\Repository;

use app\modules\AccessLogMonitoring\Domain\AccessLogEntry\Collection\AccessLogEntryCollection;
use app\modules\AccessLogMonitoring\Domain\AccessLogEntry\Entity\AccessLogEntry;
use app\modules\DBAL\ClickhouseConnection;
use ClickHouseDB\Client;
use Doctrine\Common\Collections\Collection;

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

    public function queryBetweenDates(\DateTimeImmutable $startDateDateTime, \DateTimeImmutable $finishDateDateTime): Collection
    {
        $rows = $this->client->select(sprintf(
            "SELECT * FROM nginx_access_log where dateTime > '%s' and dateTime < '%s'",
            $startDateDateTime->format('Y-m-d H:i:s'),
            $finishDateDateTime->format('Y-m-d H:i:s')
        ))->rows();

        return AccessLogEntryCollection::fromDatabaseRows($rows);
    }
}
