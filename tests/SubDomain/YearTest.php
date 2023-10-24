<?php

namespace SubDomain;

use Mirall\CalendarWorktruckRu\SubDomain\Year;
use PHPUnit\Framework\TestCase;

class YearTest extends TestCase
{
    public function testShort()
    {
        $this->expectException(\InvalidArgumentException::class);
        $year = new Year(1969);
    }
    public function testFromStringException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $year = Year::fromString('232x');
    }
    public function testFromStringException2()
    {
        $this->expectException(\InvalidArgumentException::class);
        $year = Year::fromString('999');
    }
    public function test(){
        $year = new Year(2023);
        $year = new Year(2024);
        $year = Year::fromString('2023');
        $year = Year::fromString('2024');
    }
}
