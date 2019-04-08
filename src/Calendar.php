<?php

namespace App;

/**
 * Class Calendar.
 */
class Calendar
{
    const FIRST_YEAR = 1990;

    const MONTHS_IN_YEAR = 13;

    const DAYS_IN_MONTH = 21;

    const DAYS_IN_ODD_MONTH = 22;

    const WEEK = [
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday'
    ];

    /**
     * @param string $date
     *
     * @return string
     */
    public function getDayByDate($date): string
    {
        return self::WEEK[0];
    }
}
