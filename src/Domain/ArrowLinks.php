<?php

namespace Mirall\CalendarWorktruckRu\Domain;

use Mirall\CalendarWorktruckRu\SubDomain\Month;
use Mirall\CalendarWorktruckRu\SubDomain\Year;

class ArrowLinks
{
    public function __construct(private Year $year, private Month $month)
    {
    }
    public function nextMonthLink()
    {
        list($year, $month) = $this->getNextDate();
        return '/calendar/' . $year . '/' . $month;
    }
    public function previousMonthLink()
    {
        list($year, $month) = $this->getPreviousDate();
        return '/calendar/' . $year . '/' . $month;
    }
    private function getNextDate()
    {
        if($this->month->int() === 12){
            return [$this->year->int() + 1, 1];
        }
        return [$this->year->int(), $this->month->int() + 1];
    }
    private function getPreviousDate()
    {
        if($this->month->int() === 1){
            return [$this->year->int() - 1, 12];
        }
        return [$this->year->int(), $this->month->int() - 1];
    }
}