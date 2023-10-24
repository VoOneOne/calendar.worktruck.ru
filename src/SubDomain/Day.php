<?php

namespace Mirall\CalendarWorktruckRu\SubDomain;

readonly class Day
{
    public function __construct(private int $day)
    {
        if($day < 1 || $day > 31){
            throw new \InvalidArgumentException('Day of the week cannot be less than 1 and greater than 31');
        }
    }
    public function int(): int
    {
        return $this->day;
    }
}