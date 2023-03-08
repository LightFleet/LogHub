<?php

namespace app\modules\AccessLogMonitoring\Domain\AccessLogEntry\Repository;

use app\modules\AccessLogMonitoring\Domain\AccessLogEntry\Entity\AccessLogEntry;

class ClickhouseLogRepository implements ClickhouseLogRepositoryInterface
{
    public function save(AccessLogEntry $log): void
    {
    }
}
