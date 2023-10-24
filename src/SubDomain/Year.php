<?php

namespace Mirall\CalendarWorktruckRu\SubDomain;

readonly class Year
{
    public function __construct(private int $year)
    {
        if($this->year <= 1970) {
            throw new \InvalidArgumentException("Expected year over 1970, transferred $year");
        }
        if($this->year > 9999) {
            throw new \InvalidArgumentException("Expected year below 9999, transferred $year");
        }

    }
    public static function fromString(string $year): self
    {
        if(preg_match('/[^0-9]/', $year)){
            throw new \InvalidArgumentException("A string of numbers was expected, we received $year");
        }
        return new self(intval($year));
    }
    public function int(): int
    {
        return $this->year;
    }

}