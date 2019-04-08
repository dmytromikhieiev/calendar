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
     * testGetDayByDate
     */
    public function testGetDayByDate()
    {
        $date = '17.11.2013';
        $calendar = new Calendar();
        $res = $calendar->getDayByDate($date);
        $this->assertTrue(is_string($res));
        $this->assertContains($res, Calendar::WEEK);
    }
}
