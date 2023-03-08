<?php

namespace app\modules\AccessLogMonitoring\Usecase\Service;

use app\modules\AccessLogMonitoring\Domain\AccessLogEntry\Entity\AccessLogEntry;
use app\modules\AccessLogMonitoring\Domain\AccessLogEntry\Repository\ClickhouseLogRepository;
use app\modules\AccessLogMonitoring\Infrastructure\AccessLogParser\NginxAccessLogParser;

class LogMonitor
{
    public function __construct(
        public NginxAccessLogParser $accessLogParser,
        public ClickhouseLogRepository $clickhouseLogRepository,
    )
    {
    }

    public function monitor($handle, string $logFilePath)
    {
        if (!is_resource($handle)) {
            throw new \LogicException('Access log is not resource! ' . __METHOD__);
        }

        $this->accessLogParser->setOffsetToTheEndOfTheFile($handle);

        while (true) {
            clearstatcache();
            if ($this->accessLogParser->endOfTheFileIsNotReached($handle, $logFilePath)) {
                $accessLogParsedLine = $this->parseAccessLogLine($handle);

                echo 'Access log entry successfully parsed. Ip:' . $accessLogParsedLine->getIp();
                echo PHP_EOL;

                $this->clickhouseLogRepository->save($accessLogParsedLine);
            }
            sleep(1);
        }
    }

    private function parseAccessLogLine($handle): AccessLogEntry
    {
        $accessLogLineParsingResult = $this->accessLogParser->parseAccessLogLine($handle);

        return new AccessLogEntry(...$this->splitAccessLogLine($accessLogLineParsingResult));
    }

    private function splitAccessLogLine(string $accessLogLineParsingResult)
    {
        $regex = '/^(\S+) (\S+) (\S+) \[(.*?)\] "(.*?)" (\d+) (\d+) "(.*?)" "(.*?)"/';

        $matches = [];
        if (preg_match($regex, $accessLogLineParsingResult, $matches)) {
            $ip = $matches[1];
            $date = $matches[4];
            $request = $matches[5];
            $status = $matches[6];
            $size = $matches[7];
            $referer = $matches[8];
            $userAgent = $matches[9];
        }

        return [$ip, $date, $request, $status, $size, $referer, $userAgent];
    }
}