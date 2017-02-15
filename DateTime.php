<?php

namespace Havvg\Tools;

final class DateTime
{
    /**
     * @return \DateTimeImmutable
     */
    public static function ensureImmutable(\DateTimeInterface $datetime)
    {
        if ($datetime instanceof \DateTimeImmutable) {
            return $datetime;
        }

        if ($datetime instanceof \DateTime) {
            return \DateTimeImmutable::createFromMutable($datetime);
        }

        $immutable = \DateTimeImmutable::createFromFormat(\DateTime::ISO8601, $datetime->format(\DateTime::ISO8601), $datetime->getTimezone());
        if (!$immutable instanceof \DateTimeImmutable) {
            throw new \InvalidArgumentException('The given datetime could not be converted to an immutable datetime.');
        }

        return $immutable;
    }
}
