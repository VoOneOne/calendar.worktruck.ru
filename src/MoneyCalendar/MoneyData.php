<?php

namespace Mirall\CalendarWorktruckRu\MoneyCalendar;

use Mirall\CalendarWorktruckRu\Domain\DayMoney;
use Mirall\CalendarWorktruckRu\Domain\DayMoneyInterface;
use Mirall\CalendarWorktruckRu\SubDomain\Day;
use Mirall\CalendarWorktruckRu\SubDomain\Month;
use Mirall\CalendarWorktruckRu\SubDomain\Year;

class MoneyData
{
    private array $daysMoney = [];
    private bool $formatted = false;
    const MONEY_KEY = ['rasplan', 'rasfact', 'prihplan', 'prihfact'];
    public function __construct(private array $moneyData, private Year $year, private Month $month)
    {
        foreach (self::MONEY_KEY as $key){
            if(!array_key_exists($key, $moneyData)){
                throw new \InvalidArgumentException("Expected array with key '$key'");
            }
            $this->validate($this->moneyData[$key]);
        }
    }
    private function validate($daysMoney): void
    {
        foreach ($daysMoney as $dayMoney){
            if(!array_key_exists('date', $dayMoney)){
                throw new \InvalidArgumentException();
            }
            if(!array_key_exists('sum', $dayMoney)){
                throw new \InvalidArgumentException();
            }
        }
    }
    public function day(Day $day): DayMoneyInterface
    {
        if($this->formatted === false){
            $this->format();
        }
        if(array_key_exists($day->int(), $this->daysMoney)){
            $dayMoneyData = $this->daysMoney[$day->int()];
        } else {
            $dayMoneyData = [];
        }
        return new DayMoney($dayMoneyData, $day);
    }
    private function daysArrayFormat($key){
        foreach ($this->moneyData[$key] as $moneyField){
            $day = new Day(intval(substr($moneyField['date'], 0, 2)));
            $sum = intval(preg_replace("/[^0-9,]/", "", $moneyField['sum']));
            $this->daysMoney[$day->int()][$key] = $sum;
        }
    }
    private function format(){
        foreach (self::MONEY_KEY as $key) {
            $this->daysArrayFormat($key);
        }
        $this->formatted = true;
    }
}