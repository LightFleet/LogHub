<?php

namespace app\modules\AccessLogMonitoring\Domain\AccessLogEntry\Collection;

use app\modules\AccessLogMonitoring\Domain\AccessLogEntry\Entity\AccessLogEntry;
use Doctrine\Common\Collections\ArrayCollection;

class AccessLogEntryCollection extends ArrayCollection
{
    public static function fromDatabaseRows(array $elements): self
    {
        $self = new self;

        foreach ($elements as $el) {
            $self->add(new AccessLogEntry(
                $el['ip'],
                $el['dateTime'],
                $el['method'],
                $el['responseCode'],
                $el['responseSize'],
                $el['referrer'],
                $el['userAgent'],
            )
            );
        }

        return $self;
    }
}