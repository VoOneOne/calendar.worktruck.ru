<?php

namespace Mirall\CalendarWorktruckRu\Domain;

use Mirall\CalendarWorktruckRu\SubDomain\Day;

readonly class DayMoney implements DayMoneyInterface
{
    public function __construct(private array $money, private Day $day)
    {
    }
    public function array(): array
    {
        return $this->money + ['day' => $this->day->int()];
    }
}