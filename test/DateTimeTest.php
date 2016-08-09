<?php

namespace PiotrekR\DateTimeTest;

use PiotrekR\DateTime\DateTime;

/**
 * Class DateTimeTest
 * @package PiotrekR\DateTimeTest
 */
class DateTimeTest extends \PHPUnit_Framework_TestCase
{
    public function testNowFactory()
    {
        self::assertInstanceOf(DateTime::class, DateTime::now());
    }

    public function testStartOfDay()
    {
        $date = new DateTime();
        $expected = $date->format('Y-m-d H:i:s');
        $date2 = $date->startOfDay();

        self::assertNotSame($date2, $date);
        self::assertEquals($date->format('Y-m-d'), $date2->format('Y-m-d'));
        self::assertEquals($expected, $date->format('Y-m-d H:i:s'));
        self::assertEquals('00:00:00', $date2->format('H:i:s'));
    }

    public function testEndOfDay()
    {
        $date = new DateTime();
        $expected = $date->format('Y-m-d H:i:s');
        $date2 = $date->endOfDay();

        self::assertNotSame($date2, $date);
        self::assertEquals($date->format('Y-m-d'), $date2->format('Y-m-d'));
        self::assertEquals($expected, $date->format('Y-m-d H:i:s'));
        self::assertEquals('23:59:59', $date2->format('H:i:s'));
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
}
