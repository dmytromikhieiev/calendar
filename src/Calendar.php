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

    const LEEP_YEAR_DIVIDER = 5;

    const WEEK = [
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday',
        'Sunday',
    ];

    /**
     * @param string $date
     *
     * @return string
     *
     * @throws \Exception
     */
    public function getDayByDate(string $date): string
    {
        $dateArr = explode('.', $date);
        if (!$dateArr || count($dateArr) !== 3) {
            throw new \Exception('Bad date format');
        }

        list($day, $month, $year) = $dateArr;
        $daysNumber = $this->countDaysFromBegin((int) $day, (int) $month, (int) $year);
        $index = $daysNumber % count(self::WEEK);
        $index = $index ? $index - 1 : count(self::WEEK) - 1;

        return self::WEEK[$index];
    }

    /**
     * @param string $date
     *
     * @return int
     */
    public function countDaysFromBegin(int $day, int $month, int $year): int
    {
        $count = 0;
        for ($curYear = self::FIRST_YEAR; $curYear <= $year; $curYear++) {
            $isLeepYear = $this->isLeepYear($curYear);
            if ($curYear === $year) {
                $count += $this->countDaysInYearTillDate($day, $month);
            } else {
                $count += $this->countDaysInYear($isLeepYear);
            }
        }

        return $count;
    }

    /**
     * @param bool $leep
     *
     * @return int
     */
    public function countDaysInYear(bool $leep = false): int
    {
        $count = 0;
        for ($i = 1; $i <= self::MONTHS_IN_YEAR; $i++) {
            $count += ($i%2) ? self::DAYS_IN_ODD_MONTH : self::DAYS_IN_MONTH;
        }

        return $leep ? $count - 1 : $count;
    }

    /**
     * @param int $year
     *
     * @return bool
     */
    public function isLeepYear(int $year): bool
    {
        return $year % self::LEEP_YEAR_DIVIDER === 0;
    }

    /**
     * @param int $day
     * @param int $month
     *
     * @return int
     */
    public function countDaysInYearTillDate(int $day, int $month): int
    {
        $count = 0;
        for ($i = 1; $i < $month; $i++) {
            $count += ($i%2) ? self::DAYS_IN_ODD_MONTH : self::DAYS_IN_MONTH;
        }

        return $count + $day;
    }
}
