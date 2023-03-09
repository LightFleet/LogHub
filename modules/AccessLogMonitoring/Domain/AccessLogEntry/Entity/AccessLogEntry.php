<?php

namespace app\modules\AccessLogMonitoring\Domain\AccessLogEntry\Entity;

class AccessLogEntry
{
    public function __construct(
        private string $ip,
        private string $date,
        private string $request,
        private string $status,
        private string $size,
        private string $referer,
        private string $userAgent
    )
    {
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function getDate(): string
    {
        $dateTime = new \DateTimeImmutable($this->date);
        return ($dateTime)->format('Y-m-d H:m:s');
    }

    public function getRequest(): string
    {
        return $this->request;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getSize(): string
    {
        return $this->size;
    }

    public function getReferer(): string
    {
        return $this->referer;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    public function toArray(): array
    {
        return [
            $this->getIp(),
            $this->getDate(),
            $this->getRequest(),
            $this->getStatus(),
            $this->getSize(),
            $this->getReferer(),
            $this->getUserAgent(),
        ];
    }
}