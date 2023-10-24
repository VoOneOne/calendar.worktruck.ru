<?php

namespace SubDomain;

use Mirall\CalendarWorktruckRu\SubDomain\Day;
use PHPUnit\Framework\TestCase;

class DayTest extends TestCase
{
    public function test()
    {
        $day = new Day(1);
        $day = new Day(31);
    }
    public function testExceptionZero()
    {
        $this->expectException(\InvalidArgumentException::class);
        $day = new Day(0);
    }
    public function testException40()
    {
        $this->expectException(\InvalidArgumentException::class);
        $day = new Day(40);
    }
}
