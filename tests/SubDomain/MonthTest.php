<?php

namespace SubDomain;

use Mirall\CalendarWorktruckRu\SubDomain\Month;
use PHPUnit\Framework\TestCase;

class MonthTest extends TestCase
{
    public function test()
    {
        $month = new Month(1);
        $month = new Month(12);
    }
    public function testExceptionZero()
    {
        $this->expectException(\InvalidArgumentException::class);
        $month = new Month(0);
    }
    public function testException40()
    {
        $this->expectException(\InvalidArgumentException::class);
        $month = new Month(40);
    }
}
