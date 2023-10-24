<?php

namespace Mirall\CalendarWorktruckRu\SubDomain;

readonly class Month
{
    public function __construct(private int $number)
    {
        if($number < 1 || $number > 12){
            throw new \InvalidArgumentException('Expected month number from 1 to 12');
        }
    }
    public function int(): int
    {
        return $this->number;
    }
}