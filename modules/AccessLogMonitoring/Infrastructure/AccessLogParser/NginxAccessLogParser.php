<?php

namespace app\modules\AccessLogMonitoring\Infrastructure\AccessLogParser;

class NginxAccessLogParser
{
    public function setOffsetToTheEndOfTheFile($handle): void
    {
        if (!is_resource($handle)) {
            throw new \LogicException('Access log is not resource!' . __METHOD__);
        }

        if (fseek($handle, 0, SEEK_END) === -1) {
            throw new \RuntimeException('An error occurred while trying to set the offset in the access log file.');
        }
    }

    public function endOfTheFileIsNotReached($handle, string $logFilePath)
    {
        if (!is_resource($handle)) {
            throw new \LogicException('Access log is not resource! ' . __METHOD__);
        }

        $filesize = filesize($logFilePath);
        $ftell = ftell($handle);

        if ($filesize === false) {
            throw new \RuntimeException('An error occurred while trying to set the file size in the access log file.');
        }

        if ($ftell === false) {
            throw new \RuntimeException('An error occurred while trying to get current position in the access log file.');
        }

        return $filesize > $ftell;
    }

    public function parseAccessLogLine($handle): string
    {
        if (!is_resource($handle)) {
            throw new \LogicException('Access log is not resource! ' . __METHOD__);
        }

        $accessLogLineParsingResult = fgets($handle);

        if ($accessLogLineParsingResult === false) {
            throw new \RuntimeException('An error occurred while trying to parse access log file line.');
        }

        return $accessLogLineParsingResult;
    }
}