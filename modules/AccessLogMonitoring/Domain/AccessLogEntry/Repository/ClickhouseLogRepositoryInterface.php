<?php

namespace app\modules\AccessLogMonitoring\Domain\AccessLogEntry\Repository;

use app\modules\AccessLogMonitoring\Domain\AccessLogEntry\Entity\AccessLogEntry;

interface ClickhouseLogRepositoryInterface
{
    public function save(AccessLogEntry $accessLogEntry): void;
}