<?php

namespace Mirall\CalendarWorktruckRu\SubDomain;

readonly class Month
{
    const MONTHS = [
            1 => 'Январь',
            2 => 'Февраль',
            3 => 'Март',
            4 => 'Апрель',
            5 => 'Май',
            6 => 'Июнь',
            7 => 'Июль',
            8 => 'Август',
            9 => 'Сентябрь',
            10 => 'Октябрь',
            11 => 'Ноябрь',
            12 => 'Декабрь',
        ];
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
    public function name(): string
    {
        return self::MONTHS[$this->number];
    }
}