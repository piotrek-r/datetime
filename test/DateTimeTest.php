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
        $pairs = [
            '2016-01-01 11:23:45' => '2016-01-01 00:00:00',
            '2016-02-29 11:23:45' => '2016-02-29 00:00:00',
            '2016-03-01 11:23:45' => '2016-03-01 00:00:00',
            '2016-09-03 11:23:45' => '2016-09-03 00:00:00',
            '2016-12-31 11:23:45' => '2016-12-31 00:00:00',
        ];

        foreach ($pairs as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->startOfDay()->format('Y-m-d H:i:s'));
        }
    }

    public function testEndOfDay()
    {
        $pairs = [
            '2016-01-01 11:23:45' => '2016-01-01 23:59:59',
            '2016-02-29 11:23:45' => '2016-02-29 23:59:59',
            '2016-03-01 11:23:45' => '2016-03-01 23:59:59',
            '2016-09-03 11:23:45' => '2016-09-03 23:59:59',
            '2016-12-31 11:23:45' => '2016-12-31 23:59:59',
        ];

        foreach ($pairs as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->endOfDay()->format('Y-m-d H:i:s'));
        }
    }

    public function testStartOfWeekWithFirstDayMondayAndStartOfDay()
    {
        $pairs = [
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

        foreach ($pairs as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->startOfWeek(true, DateTime::DOW_MONDAY)->format('Y-m-d H:i:s'));
        }
    }

    public function testStartOfWeekWithFirstDayMonday()
    {
        $pairs = [
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

        foreach ($pairs as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->startOfWeek(false, DateTime::DOW_MONDAY)->format('Y-m-d H:i:s'));
        }
    }

    public function testStartOfWeekWithFirstDaySundayAndStartOfDay()
    {
        $pairs = [
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

        foreach ($pairs as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->startOfWeek(true, DateTime::DOW_SUNDAY)->format('Y-m-d H:i:s'));
        }
    }

    public function testStartOfWeekWithFirstDaySunday()
    {
        $pairs = [
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

        foreach ($pairs as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->startOfWeek(false, DateTime::DOW_SUNDAY)->format('Y-m-d H:i:s'));
        }
    }

    public function testEndOfWeekWithLastDaySundayAndEndOfDay()
    {
        $pairs = [
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

        foreach ($pairs as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->endOfWeek(true, DateTime::DOW_SUNDAY)->format('Y-m-d H:i:s'));
        }
    }

    public function testEndOfWeekWithLastDaySunday()
    {
        $pairs = [
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

        foreach ($pairs as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->endOfWeek(false, DateTime::DOW_SUNDAY)->format('Y-m-d H:i:s'));
        }
    }

    public function testEndOfWeekWithLastDaySaturdayAndEndOfDay()
    {
        $pairs = [
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

        foreach ($pairs as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->endOfWeek(true, DateTime::DOW_SATURDAY)->format('Y-m-d H:i:s'));
        }
    }

    public function testEndOfWeekWithLastDaySaturday()
    {
        $pairs = [
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

        foreach ($pairs as $entered => $expected) {
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
        $pairs = [
            '2016-01-01 12:34:56' => '2016-01-01 00:00:00',
            '2016-02-01 12:34:56' => '2016-01-01 00:00:00',
            '2016-02-29 12:34:56' => '2016-01-01 00:00:00',
            '2016-03-01 12:34:56' => '2016-01-01 00:00:00',
            '2016-09-10 12:34:56' => '2016-01-01 00:00:00',
            '2016-12-31 12:34:56' => '2016-01-01 00:00:00',
        ];

        foreach ($pairs as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->startOfYear(true)->format('Y-m-d H:i:s'));
        }
    }

    public function testStartOfYearWithoutStartOfDay()
    {
        $pairs = [
            '2016-01-01 12:34:56' => '2016-01-01 12:34:56',
            '2016-02-01 12:34:56' => '2016-01-01 12:34:56',
            '2016-02-29 12:34:56' => '2016-01-01 12:34:56',
            '2016-03-01 12:34:56' => '2016-01-01 12:34:56',
            '2016-09-10 12:34:56' => '2016-01-01 12:34:56',
            '2016-12-31 12:34:56' => '2016-01-01 12:34:56',
        ];

        foreach ($pairs as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->startOfYear(false)->format('Y-m-d H:i:s'));
        }
    }

    public function testEndOfYearWithEndOfDay()
    {
        $pairs = [
            '2016-01-01 12:34:56' => '2016-12-31 23:59:59',
            '2016-02-01 12:34:56' => '2016-12-31 23:59:59',
            '2016-02-29 12:34:56' => '2016-12-31 23:59:59',
            '2016-03-01 12:34:56' => '2016-12-31 23:59:59',
            '2016-09-10 12:34:56' => '2016-12-31 23:59:59',
            '2016-12-31 12:34:56' => '2016-12-31 23:59:59',
        ];

        foreach ($pairs as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->endOfYear(true)->format('Y-m-d H:i:s'));
        }
    }

    public function testEndOfYearWithoutEndOfDay()
    {
        $pairs = [
            '2016-01-01 12:34:56' => '2016-12-31 12:34:56',
            '2016-02-01 12:34:56' => '2016-12-31 12:34:56',
            '2016-02-29 12:34:56' => '2016-12-31 12:34:56',
            '2016-03-01 12:34:56' => '2016-12-31 12:34:56',
            '2016-09-10 12:34:56' => '2016-12-31 12:34:56',
            '2016-12-31 12:34:56' => '2016-12-31 12:34:56',
        ];

        foreach ($pairs as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->endOfYear(false)->format('Y-m-d H:i:s'));
        }
    }

    public function testYesterday()
    {
        $pairs = [
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

        foreach ($pairs as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->yesterday()->format('Y-m-d H:i:s'));
        }
    }

    public function testTomorrow()
    {
        $pairs = [
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

        foreach ($pairs as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->tomorrow()->format('Y-m-d H:i:s'));
        }
    }

    public function testDow()
    {
        $pairs = [
            '2016-09-05 12:34:56' => DateTime::DOW_MONDAY,
            '2016-09-06 12:34:56' => DateTime::DOW_TUESDAY,
            '2016-09-07 12:34:56' => DateTime::DOW_WEDNESDAY,
            '2016-09-08 12:34:56' => DateTime::DOW_THURSDAY,
            '2016-09-09 12:34:56' => DateTime::DOW_FRIDAY,
            '2016-09-10 12:34:56' => DateTime::DOW_SATURDAY,
            '2016-09-11 12:34:56' => DateTime::DOW_SUNDAY,
        ];

        foreach ($pairs as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->dow());
        }
    }

    public function testIsWeekday()
    {
        $pairs = [
            '2016-09-05 12:34:56' => true,
            '2016-09-06 12:34:56' => true,
            '2016-09-07 12:34:56' => true,
            '2016-09-08 12:34:56' => true,
            '2016-09-09 12:34:56' => true,
            '2016-09-10 12:34:56' => false,
            '2016-09-11 12:34:56' => false,
        ];

        foreach ($pairs as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->isWeekday());
        }
    }

    public function testIsWeekend()
    {
        $pairs = [
            '2016-09-05 12:34:56' => false,
            '2016-09-06 12:34:56' => false,
            '2016-09-07 12:34:56' => false,
            '2016-09-08 12:34:56' => false,
            '2016-09-09 12:34:56' => false,
            '2016-09-10 12:34:56' => true,
            '2016-09-11 12:34:56' => true,
        ];

        foreach ($pairs as $entered => $expected) {
            $date = new DateTime($entered);
            self::assertEquals($expected, $date->isWeekend());
        }
    }
}
