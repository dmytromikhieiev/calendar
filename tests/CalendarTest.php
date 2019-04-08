<?php

namespace App\Tests;

use App\Calendar;
use PHPUnit\Framework\TestCase;

/**
 * Class CalendarTest.
 */
class CalendarTest extends TestCase
{
    /**
     * @var Calendar
     */
    private $calendar;

    /**
     * before each test
     */
    public function setUp()
    {
        $this->calendar = new Calendar();
    }

    /**
     * testGetDayByDate
     */
    public function testGetDayByDate()
    {
        $date = '02.01.1990';
        $res = $this->calendar->getDayByDate($date);
        $this->assertTrue(is_string($res));
        $this->assertContains($res, Calendar::WEEK);
        $this->assertEquals('Tuesday', $res);
        $res = $this->calendar->getDayByDate('17.11.2013');
        $this->assertTrue(is_string($res));
        $this->assertContains($res, Calendar::WEEK);
    }

    /**
     * testBadDateFormat
     */
    public function testNotADateFormat()
    {
        $this->expectException(\Exception::class);
        $date = 'baddate';
        $this->calendar->getDayByDate($date);
    }

    public function testBadFormatDate()
    {
        $this->expectException(\Exception::class);
        $date = '13.25.3216';
        $this->calendar->getDayByDate($date);
    }

    /**
     * testLeepYear
     */
    public function testLeepYear()
    {
        $this->assertTrue($this->calendar->isLeepYear(1990));
        $this->assertFalse($this->calendar->isLeepYear(1992));
        $this->assertFalse($this->calendar->isLeepYear(1993));
        $this->assertFalse($this->calendar->isLeepYear(1994));
        $this->assertTrue($this->calendar->isLeepYear(1995));
    }

    /**
     * testCountDaysInLeap
     */
    public function testCountDaysInLeap()
    {
        $this->assertEquals(280, $this->calendar->countDaysInYear());
        $this->assertEquals(279, $this->calendar->countDaysInYear(true));
    }

    /**
     * testCountDaysInYearTillDate
     */
    public function testCountDaysInYearTillDate()
    {
        $res = $this->calendar->countDaysInYearTillDate(3, 3);
        $this->assertEquals(46, $res);
        $res = $this->calendar->countDaysInYearTillDate(2, 1);
        $this->assertEquals(2, $res);
    }
}
