<?php

namespace app\modules\AccessLogMonitoring\Usecase\Service;

use app\modules\AccessLogMonitoring\Domain\AccessLogEntry\Entity\AccessLogEntry;
use app\modules\AccessLogMonitoring\Domain\AccessLogEntry\Repository\ClickhouseLogRepository;
use app\modules\AccessLogMonitoring\Infrastructure\AccessLogParser\NginxAccessLogParser;
use app\modules\AccessLogMonitoring\Usecase\Exception\DateStringIsNotInValidFormat;
use app\modules\AccessLogMonitoring\Usecase\Exception\StartDateIsGreatedThanFinishDate;
use Doctrine\Common\Collections\Collection;

class LogQuery
{
    public function __construct(
        public ClickhouseLogRepository $clickhouseLogRepository,
    )
    {
    }

    public function queryBetweenDates(
        string $startDate,
        string $finishDate,
    ): Collection
    {
        $this->validateDateTimeString($startDate);
        $this->validateDateTimeString($finishDate);

        $startDateDateTime = new \DateTimeImmutable(str_replace('#', ' ', $startDate));
        $finishDateDateTime = new \DateTimeImmutable(str_replace('#', ' ', $finishDate));

        if ($startDateDateTime > $finishDateDateTime) {
            throw new StartDateIsGreatedThanFinishDate("startDate should be before finishDate");
        }

        return $this->clickhouseLogRepository->queryBetweenDates($startDateDateTime, $finishDateDateTime);
    }

    /**
     * @throws DateStringIsNotInValidFormat
     */
    private function validateDateTimeString(string $dateTimeString): void
    {
        $validationPattern = '/^\d{4}-\d{2}-\d{2}#\d{2}:\d{2}:\d{2}$/';

        if (!preg_match($validationPattern, $dateTimeString)) {
            throw new DateStringIsNotInValidFormat("$dateTimeString is not a valid format. Accepted format: Y-m-d#H:i:s");
        }
    }
}