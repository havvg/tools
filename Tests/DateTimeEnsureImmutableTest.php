<?php

namespace Havvg\Tools\Tests;

use Havvg\Tools\DateTime;

/**
 * @covers \Havvg\Tools\DateTime::ensureImmutable
 */
final class DateTimeEnsureImmutableTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_returns_immutable_unchanged()
    {
        $datetime = new \DateTimeImmutable();

        $immutable = DateTime::ensureImmutable($datetime);

        static::assertSame($datetime, $immutable);
    }

    public function test_it_converts_datetime_into_immutable()
    {
        $datetime = new \DateTime('now');

        $immutable = DateTime::ensureImmutable($datetime);

        static::assertInstanceOf(\DateTimeImmutable::class, $immutable);
        static::assertEquals($datetime, $immutable);
    }

    public function test_it_respects_timezone()
    {
        $timezone = new \DateTimeZone('UTC');
        $datetime = new \DateTime('now', $timezone);

        $immutable = DateTime::ensureImmutable($datetime);

        static::assertEquals($timezone, $immutable->getTimezone());
    }
}
