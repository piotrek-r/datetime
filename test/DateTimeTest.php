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
}
