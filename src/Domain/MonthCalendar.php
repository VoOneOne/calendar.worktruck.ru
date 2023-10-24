<?php

namespace Mirall\CalendarWorktruckRu\Domain;

use Mirall\CalendarWorktruckRu\SubDomain\Month;
use Mirall\CalendarWorktruckRu\SubDomain\Year;

class MonthCalendar
{
    private int $dayOfMonth;
    private int $days;
    private const NOT_SET = 0;
    public function __construct(private readonly Year $year, private readonly Month $month)
    {
        $this->dayOfMonth = 1;
        $this->days = 0;
    }
    public function dayWeekBegMonth(): int
    {
        $year = $this->year->int();
        $month = $this->month->int();
        $firstDayOfMonth = strtotime("$year-$month-01");
        $dayWeekBegMonth = intval(date('w', $firstDayOfMonth));
        if($dayWeekBegMonth === 0){
            $dayWeekBegMonth = 7;
        }
        return $dayWeekBegMonth;
    }
    public function dayWeekEndMonth(): int
    {
        $year = $this->year->int();
        $month = $this->month->int();
        $lastDayOfMonth = strtotime("last day of $year-$month");
        return date('w', $lastDayOfMonth);
    }
    public function days(): int
    {
        if($this->days !== self::NOT_SET){
            return $this->days;
        }
        $year = $this->year->int();
        $month = $this->month->int();
        $this->days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        return cal_days_in_month(CAL_GREGORIAN, $month, $year);
    }
    public function dateStartMonth1CFormat(): string
    {
        if($this->month->int() < 10){
            $monthStr = '0' . $this->month->int();
        } else {
            $monthStr = strval($this->month->int());
        }
        return $this->year->int() . $monthStr . '01';
    }
    public function dateEndMonth1CFormat(): string
    {
        $days = $this->days();
        if($days < 10){
            $daysStr = '0' . $days;
        } else {
            $daysStr = strval($days);
        }
        if($this->month->int() < 10){
            $monthStr = '0' . $this->month->int();
        } else {
            $monthStr = strval($this->month->int());
        }
        return $this->year->int() . $monthStr . $daysStr;
    }

}