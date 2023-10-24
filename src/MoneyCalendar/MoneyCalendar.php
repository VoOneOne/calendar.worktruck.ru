<?php

namespace Mirall\CalendarWorktruckRu\MoneyCalendar;

use Mirall\CalendarWorktruckRu\Domain\MonthCalendar;
use Mirall\CalendarWorktruckRu\SubDomain\Day;

class MoneyCalendar
{
    public function __construct(private MonthCalendar $calendarTable, private MoneyData $moneyData)
    {
    }
    public function json()
    {
        return json_encode($this->array());
    }
    public function array()
    {
        $moneyCalendar = [];
        for ($i = 1; $i < $this->calendarTable->dayWeekBegMonth(); $i++) {
            $moneyCalendar[] = [];
        }
        for ($i = 1; $i <= $this->calendarTable->days(); $i++){
            $day = new Day($i);
            $moneyDay = $this->moneyData->day($day);
            $moneyCalendar[] = $moneyDay->array();
        }
        for($i = $this->calendarTable->dayWeekEndMonth() + 1; $i <= 7; $i++){
            $moneyCalendar[] = [];
        }
        return  $moneyCalendar;
    }
}