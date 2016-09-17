<?php

namespace PiotrekR\DateTimeTest;

use PiotrekR\DateTime\DateTime;

/**
 * Class DateTimeTest
 * @package PiotrekR\DateTimeTest
 */
class DateTimeTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateFromDateTime()
    {
        $times = [
            '2016-01-01 00:00:00',
            '2016-02-29 00:00:00',
            '2016-03-01 00:00:00',
            '2016-09-03 00:00:00',
            '2016-12-31 00:00:00',
        ];

        foreach ($times as $time) {
            self::assertEquals(
                $time,
                (DateTime::createFromDateTime(new \DateTime($time))->format('Y-m-d H:i:s'))
            );
            self::assertEquals(
                $time,
                (DateTime::createFromDateTime(new \DateTimeImmutable($time))->format('Y-m-d H:i:s'))
            );
        }
    }

    public function testNowFactory()
    {
        self::assertInstanceOf(DateTime::class, DateTime::now());
    }

    public function testStartOfDay()
    {
        $times = [
            '2016-01-01 11:23:45' => '2016-01-01 00:00:00',
            '2016-02-29 11:23:45' => '2016-02-29 00:00:00',
            '2016-03-01 11:23:45' => '2016-03-01 00:00:00',
            '2016-09-03 11:23:45' => '2016-09-03 00:00:00',
            '2016-12-31 11:23:45' => '2016-12-31 00:00:00',
        ];

        foreach ($times as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->startOfDay()->format('Y-m-d H:i:s'));
        }
    }

    public function testEndOfDay()
    {
        $times = [
            '2016-01-01 11:23:45' => '2016-01-01 23:59:59',
            '2016-02-29 11:23:45' => '2016-02-29 23:59:59',
            '2016-03-01 11:23:45' => '2016-03-01 23:59:59',
            '2016-09-03 11:23:45' => '2016-09-03 23:59:59',
            '2016-12-31 11:23:45' => '2016-12-31 23:59:59',
        ];

        foreach ($times as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->endOfDay()->format('Y-m-d H:i:s'));
        }
    }

    public function testStartOfWeekWithFirstDayMondayAndStartOfDay()
    {
        $times = [
            '2016-01-01 11:23:45' => '2015-12-28 00:00:00',
            '2016-09-03 11:23:45' => '2016-08-29 00:00:00',
            '2016-09-04 11:23:45' => '2016-08-29 00:00:00',
            '2016-09-05 11:23:45' => '2016-09-05 00:00:00',
            '2016-09-06 11:23:45' => '2016-09-05 00:00:00',
            '2016-09-07 11:23:45' => '2016-09-05 00:00:00',
            '2016-09-08 11:23:45' => '2016-09-05 00:00:00',
            '2016-09-09 11:23:45' => '2016-09-05 00:00:00',
            '2016-09-10 11:23:45' => '2016-09-05 00:00:00',
            '2016-09-11 11:23:45' => '2016-09-05 00:00:00',
            '2016-09-12 11:23:45' => '2016-09-12 00:00:00',
            '2016-09-13 11:23:45' => '2016-09-12 00:00:00',
        ];

        foreach ($times as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->startOfWeek(true, DateTime::DOW_MONDAY)->format('Y-m-d H:i:s'));
        }
    }

    public function testStartOfWeekWithFirstDayMonday()
    {
        $times = [
            '2016-01-01 11:23:45' => '2015-12-28 11:23:45',
            '2016-09-03 11:23:45' => '2016-08-29 11:23:45',
            '2016-09-04 11:23:45' => '2016-08-29 11:23:45',
            '2016-09-05 11:23:45' => '2016-09-05 11:23:45',
            '2016-09-06 11:23:45' => '2016-09-05 11:23:45',
            '2016-09-07 11:23:45' => '2016-09-05 11:23:45',
            '2016-09-08 11:23:45' => '2016-09-05 11:23:45',
            '2016-09-09 11:23:45' => '2016-09-05 11:23:45',
            '2016-09-10 11:23:45' => '2016-09-05 11:23:45',
            '2016-09-11 11:23:45' => '2016-09-05 11:23:45',
            '2016-09-12 11:23:45' => '2016-09-12 11:23:45',
            '2016-09-13 11:23:45' => '2016-09-12 11:23:45',
        ];

        foreach ($times as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->startOfWeek(false, DateTime::DOW_MONDAY)->format('Y-m-d H:i:s'));
        }
    }

    public function testStartOfWeekWithFirstDaySundayAndStartOfDay()
    {
        $times = [
            '2016-01-01 11:23:45' => '2015-12-27 00:00:00',
            '2016-09-03 11:23:45' => '2016-08-28 00:00:00',
            '2016-09-04 11:23:45' => '2016-09-04 00:00:00',
            '2016-09-05 11:23:45' => '2016-09-04 00:00:00',
            '2016-09-06 11:23:45' => '2016-09-04 00:00:00',
            '2016-09-07 11:23:45' => '2016-09-04 00:00:00',
            '2016-09-08 11:23:45' => '2016-09-04 00:00:00',
            '2016-09-09 11:23:45' => '2016-09-04 00:00:00',
            '2016-09-10 11:23:45' => '2016-09-04 00:00:00',
            '2016-09-11 11:23:45' => '2016-09-11 00:00:00',
            '2016-09-12 11:23:45' => '2016-09-11 00:00:00',
            '2016-09-13 11:23:45' => '2016-09-11 00:00:00',
        ];

        foreach ($times as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->startOfWeek(true, DateTime::DOW_SUNDAY)->format('Y-m-d H:i:s'));
        }
    }

    public function testStartOfWeekWithFirstDaySunday()
    {
        $times = [
            '2016-01-01 11:23:45' => '2015-12-27 11:23:45',
            '2016-09-03 11:23:45' => '2016-08-28 11:23:45',
            '2016-09-04 11:23:45' => '2016-09-04 11:23:45',
            '2016-09-05 11:23:45' => '2016-09-04 11:23:45',
            '2016-09-06 11:23:45' => '2016-09-04 11:23:45',
            '2016-09-07 11:23:45' => '2016-09-04 11:23:45',
            '2016-09-08 11:23:45' => '2016-09-04 11:23:45',
            '2016-09-09 11:23:45' => '2016-09-04 11:23:45',
            '2016-09-10 11:23:45' => '2016-09-04 11:23:45',
            '2016-09-11 11:23:45' => '2016-09-11 11:23:45',
            '2016-09-12 11:23:45' => '2016-09-11 11:23:45',
            '2016-09-13 11:23:45' => '2016-09-11 11:23:45',
        ];

        foreach ($times as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->startOfWeek(false, DateTime::DOW_SUNDAY)->format('Y-m-d H:i:s'));
        }
    }

    public function testEndOfWeekWithLastDaySundayAndEndOfDay()
    {
        $times = [
            '2016-01-01 11:23:45' => '2016-01-03 23:59:59',
            '2016-09-03 11:23:45' => '2016-09-04 23:59:59',
            '2016-09-04 11:23:45' => '2016-09-04 23:59:59',
            '2016-09-05 11:23:45' => '2016-09-11 23:59:59',
            '2016-09-06 11:23:45' => '2016-09-11 23:59:59',
            '2016-09-07 11:23:45' => '2016-09-11 23:59:59',
            '2016-09-08 11:23:45' => '2016-09-11 23:59:59',
            '2016-09-09 11:23:45' => '2016-09-11 23:59:59',
            '2016-09-10 11:23:45' => '2016-09-11 23:59:59',
            '2016-09-11 11:23:45' => '2016-09-11 23:59:59',
            '2016-09-12 11:23:45' => '2016-09-18 23:59:59',
            '2016-09-13 11:23:45' => '2016-09-18 23:59:59',
        ];

        foreach ($times as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->endOfWeek(true, DateTime::DOW_SUNDAY)->format('Y-m-d H:i:s'));
        }
    }

    public function testEndOfWeekWithLastDaySunday()
    {
        $times = [
            '2016-01-01 11:23:45' => '2016-01-03 11:23:45',
            '2016-09-03 11:23:45' => '2016-09-04 11:23:45',
            '2016-09-04 11:23:45' => '2016-09-04 11:23:45',
            '2016-09-05 11:23:45' => '2016-09-11 11:23:45',
            '2016-09-06 11:23:45' => '2016-09-11 11:23:45',
            '2016-09-07 11:23:45' => '2016-09-11 11:23:45',
            '2016-09-08 11:23:45' => '2016-09-11 11:23:45',
            '2016-09-09 11:23:45' => '2016-09-11 11:23:45',
            '2016-09-10 11:23:45' => '2016-09-11 11:23:45',
            '2016-09-11 11:23:45' => '2016-09-11 11:23:45',
            '2016-09-12 11:23:45' => '2016-09-18 11:23:45',
            '2016-09-13 11:23:45' => '2016-09-18 11:23:45',
        ];

        foreach ($times as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->endOfWeek(false, DateTime::DOW_SUNDAY)->format('Y-m-d H:i:s'));
        }
    }

    public function testEndOfWeekWithLastDaySaturdayAndEndOfDay()
    {
        $times = [
            '2016-01-01 11:23:45' => '2016-01-02 23:59:59',
            '2016-09-03 11:23:45' => '2016-09-03 23:59:59',
            '2016-09-04 11:23:45' => '2016-09-10 23:59:59',
            '2016-09-05 11:23:45' => '2016-09-10 23:59:59',
            '2016-09-06 11:23:45' => '2016-09-10 23:59:59',
            '2016-09-07 11:23:45' => '2016-09-10 23:59:59',
            '2016-09-08 11:23:45' => '2016-09-10 23:59:59',
            '2016-09-09 11:23:45' => '2016-09-10 23:59:59',
            '2016-09-10 11:23:45' => '2016-09-10 23:59:59',
            '2016-09-11 11:23:45' => '2016-09-17 23:59:59',
            '2016-09-12 11:23:45' => '2016-09-17 23:59:59',
            '2016-09-13 11:23:45' => '2016-09-17 23:59:59',
        ];

        foreach ($times as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->endOfWeek(true, DateTime::DOW_SATURDAY)->format('Y-m-d H:i:s'));
        }
    }

    public function testEndOfWeekWithLastDaySaturday()
    {
        $times = [
            '2016-01-01 11:23:45' => '2016-01-02 11:23:45',
            '2016-09-03 11:23:45' => '2016-09-03 11:23:45',
            '2016-09-04 11:23:45' => '2016-09-10 11:23:45',
            '2016-09-05 11:23:45' => '2016-09-10 11:23:45',
            '2016-09-06 11:23:45' => '2016-09-10 11:23:45',
            '2016-09-07 11:23:45' => '2016-09-10 11:23:45',
            '2016-09-08 11:23:45' => '2016-09-10 11:23:45',
            '2016-09-09 11:23:45' => '2016-09-10 11:23:45',
            '2016-09-10 11:23:45' => '2016-09-10 11:23:45',
            '2016-09-11 11:23:45' => '2016-09-17 11:23:45',
            '2016-09-12 11:23:45' => '2016-09-17 11:23:45',
            '2016-09-13 11:23:45' => '2016-09-17 11:23:45',
        ];

        foreach ($times as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->endOfWeek(false, DateTime::DOW_SATURDAY)->format('Y-m-d H:i:s'));
        }
    }

    public function testStartOfMonthWithStartOfDay()
    {
        $date = new DateTime();
        $expected = $date->format('Y-m-d H:i:s');
        $expected2 = $date->format('Y-m-01 00:00:00');
        $date2 = $date->startOfMonth(true);

        self::assertNotSame($date2, $date);
        self::assertEquals($expected, $date->format('Y-m-d H:i:s'));
        self::assertEquals($expected2, $date2->format('Y-m-d H:i:s'));
    }

    public function testStartOfMonthWithoutStartOfDay()
    {
        $date = new DateTime();
        $expected = $date->format('Y-m-d H:i:s');
        $expected2 = $date->format('Y-m-01 H:i:s');
        $date2 = $date->startOfMonth(false);

        self::assertNotSame($date2, $date);
        self::assertEquals($expected, $date->format('Y-m-d H:i:s'));
        self::assertEquals($expected2, $date2->format('Y-m-d H:i:s'));
    }

    public function testEndOfMonthWithEndOfDay()
    {
        $date = new DateTime();
        $expected = $date->format('Y-m-d H:i:s');
        $expected2 = $date->format('Y-m-t 23:59:59');
        $date2 = $date->endOfMonth(true);

        self::assertNotSame($date2, $date);
        self::assertEquals($expected, $date->format('Y-m-d H:i:s'));
        self::assertEquals($expected2, $date2->format('Y-m-d H:i:s'));
    }

    public function testEndOfMonthWithoutEndOfDay()
    {
        $date = new DateTime();
        $expected = $date->format('Y-m-d H:i:s');
        $expected2 = $date->format('Y-m-t H:i:s');
        $date2 = $date->endOfMonth(false);

        self::assertNotSame($date2, $date);
        self::assertEquals($expected, $date->format('Y-m-d H:i:s'));
        self::assertEquals($expected2, $date2->format('Y-m-d H:i:s'));
    }

    public function testStartOfYearWithStartOfDay()
    {
        $times = [
            '2016-01-01 12:34:56' => '2016-01-01 00:00:00',
            '2016-02-01 12:34:56' => '2016-01-01 00:00:00',
            '2016-02-29 12:34:56' => '2016-01-01 00:00:00',
            '2016-03-01 12:34:56' => '2016-01-01 00:00:00',
            '2016-09-10 12:34:56' => '2016-01-01 00:00:00',
            '2016-12-31 12:34:56' => '2016-01-01 00:00:00',
        ];

        foreach ($times as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->startOfYear(true)->format('Y-m-d H:i:s'));
        }
    }

    public function testStartOfYearWithoutStartOfDay()
    {
        $times = [
            '2016-01-01 12:34:56' => '2016-01-01 12:34:56',
            '2016-02-01 12:34:56' => '2016-01-01 12:34:56',
            '2016-02-29 12:34:56' => '2016-01-01 12:34:56',
            '2016-03-01 12:34:56' => '2016-01-01 12:34:56',
            '2016-09-10 12:34:56' => '2016-01-01 12:34:56',
            '2016-12-31 12:34:56' => '2016-01-01 12:34:56',
        ];

        foreach ($times as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->startOfYear(false)->format('Y-m-d H:i:s'));
        }
    }

    public function testEndOfYearWithEndOfDay()
    {
        $times = [
            '2016-01-01 12:34:56' => '2016-12-31 23:59:59',
            '2016-02-01 12:34:56' => '2016-12-31 23:59:59',
            '2016-02-29 12:34:56' => '2016-12-31 23:59:59',
            '2016-03-01 12:34:56' => '2016-12-31 23:59:59',
            '2016-09-10 12:34:56' => '2016-12-31 23:59:59',
            '2016-12-31 12:34:56' => '2016-12-31 23:59:59',
        ];

        foreach ($times as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->endOfYear(true)->format('Y-m-d H:i:s'));
        }
    }

    public function testEndOfYearWithoutEndOfDay()
    {
        $times = [
            '2016-01-01 12:34:56' => '2016-12-31 12:34:56',
            '2016-02-01 12:34:56' => '2016-12-31 12:34:56',
            '2016-02-29 12:34:56' => '2016-12-31 12:34:56',
            '2016-03-01 12:34:56' => '2016-12-31 12:34:56',
            '2016-09-10 12:34:56' => '2016-12-31 12:34:56',
            '2016-12-31 12:34:56' => '2016-12-31 12:34:56',
        ];

        foreach ($times as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->endOfYear(false)->format('Y-m-d H:i:s'));
        }
    }

    public function testYesterday()
    {
        $times = [
            '2015-12-31 12:34:56' => '2015-12-30 12:34:56',
            '2016-01-01 12:34:56' => '2015-12-31 12:34:56',
            '2016-01-02 12:34:56' => '2016-01-01 12:34:56',
            '2016-02-01 12:34:56' => '2016-01-31 12:34:56',
            '2016-02-29 12:34:56' => '2016-02-28 12:34:56',
            '2016-03-01 12:34:56' => '2016-02-29 12:34:56',
            '2017-01-01 12:34:56' => '2016-12-31 12:34:56',
            '2017-02-28 12:34:56' => '2017-02-27 12:34:56',
            '2017-03-01 12:34:56' => '2017-02-28 12:34:56',
        ];

        foreach ($times as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->yesterday()->format('Y-m-d H:i:s'));
        }
    }

    public function testTomorrow()
    {
        $times = [
            '2015-12-31 12:34:56' => '2016-01-01 12:34:56',
            '2016-01-01 12:34:56' => '2016-01-02 12:34:56',
            '2016-01-02 12:34:56' => '2016-01-03 12:34:56',
            '2016-02-01 12:34:56' => '2016-02-02 12:34:56',
            '2016-02-29 12:34:56' => '2016-03-01 12:34:56',
            '2016-03-01 12:34:56' => '2016-03-02 12:34:56',
            '2017-01-01 12:34:56' => '2017-01-02 12:34:56',
            '2017-02-28 12:34:56' => '2017-03-01 12:34:56',
            '2017-03-01 12:34:56' => '2017-03-02 12:34:56',
        ];

        foreach ($times as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->tomorrow()->format('Y-m-d H:i:s'));
        }
    }

    public function testDow()
    {
        $times = [
            '2016-09-05 12:34:56' => DateTime::DOW_MONDAY,
            '2016-09-06 12:34:56' => DateTime::DOW_TUESDAY,
            '2016-09-07 12:34:56' => DateTime::DOW_WEDNESDAY,
            '2016-09-08 12:34:56' => DateTime::DOW_THURSDAY,
            '2016-09-09 12:34:56' => DateTime::DOW_FRIDAY,
            '2016-09-10 12:34:56' => DateTime::DOW_SATURDAY,
            '2016-09-11 12:34:56' => DateTime::DOW_SUNDAY,
        ];

        foreach ($times as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->dow());
        }
    }

    public function testIsWeekday()
    {
        $times = [
            '2016-09-05 12:34:56' => true,
            '2016-09-06 12:34:56' => true,
            '2016-09-07 12:34:56' => true,
            '2016-09-08 12:34:56' => true,
            '2016-09-09 12:34:56' => true,
            '2016-09-10 12:34:56' => false,
            '2016-09-11 12:34:56' => false,
        ];

        foreach ($times as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->isWeekday());
        }
    }

    public function testIsWeekend()
    {
        $times = [
            '2016-09-05 12:34:56' => false,
            '2016-09-06 12:34:56' => false,
            '2016-09-07 12:34:56' => false,
            '2016-09-08 12:34:56' => false,
            '2016-09-09 12:34:56' => false,
            '2016-09-10 12:34:56' => true,
            '2016-09-11 12:34:56' => true,
        ];

        foreach ($times as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->isWeekend());
        }
    }

    public function testToDateTime()
    {
        $times = [
            '2016-01-01 00:00:00',
            '2016-02-29 12:34:56',
            '2016-03-01 06:07:08',
            '2016-09-03 10:12:20',
            '2016-12-31 23:59:59',
        ];

        foreach ($times as $time) {
            $date = new DateTime($time);
            $dateReturned = $date->toDateTime();
            self::assertInstanceOf(\DateTime::class, $dateReturned);
            self::assertEquals($time, $dateReturned->format('Y-m-d H:i:s'));
        }
    }

    public function testToDateTimeImmutable()
    {
        $times = [
            '2016-01-01 00:00:00',
            '2016-02-29 12:34:56',
            '2016-03-01 06:07:08',
            '2016-09-03 10:12:20',
            '2016-12-31 23:59:59',
        ];

        foreach ($times as $time) {
            $date = new DateTime($time);
            $dateReturned = $date->toDateTimeImmutable();
            self::assertInstanceOf(\DateTimeImmutable::class, $dateReturned);
            self::assertEquals($time, $dateReturned->format('Y-m-d H:i:s'));
        }
    }

    public function testToArray()
    {
        $times = [
            '2016-01-01 00:00:00' => ['y' => 2016, 'm' => 1, 'd' => 1, 'h' => 0, 'i' => 0, 's' => 0],
            '2016-02-29 12:34:56' => ['y' => 2016, 'm' => 2, 'd' => 29, 'h' => 12, 'i' => 34, 's' => 56],
            '2016-03-01 06:07:08' => ['y' => 2016, 'm' => 3, 'd' => 1, 'h' => 6, 'i' => 7, 's' => 8],
            '2016-09-03 10:12:20' => ['y' => 2016, 'm' => 9, 'd' => 3, 'h' => 10, 'i' => 12, 's' => 20],
            '2016-12-31 23:59:59' => ['y' => 2016, 'm' => 12, 'd' => 31, 'h' => 23, 'i' => 59, 's' => 59],
        ];

        foreach ($times as $time => $expected) {
            $date = new DateTime($time);
            self::assertEquals($expected, $date->toArray());
        }
    }
}
