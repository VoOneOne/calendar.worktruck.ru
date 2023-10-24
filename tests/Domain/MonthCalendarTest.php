<?php

namespace Domain;

use Mirall\CalendarWorktruckRu\Domain\MonthCalendar;
use Mirall\CalendarWorktruckRu\SubDomain\Month;
use Mirall\CalendarWorktruckRu\SubDomain\Year;
use PHPUnit\Framework\TestCase;

class MonthCalendarTest extends TestCase
{
    public function testDate1CFormatNov(){
        $year = new Year(2023);
        $month = new Month(11);
        $monthCalendar = new MonthCalendar($year, $month);
        $this->assertSame($monthCalendar->dateStartMonth1CFormat(), '20231101');
        $this->assertSame($monthCalendar->dateEndMonth1CFormat(), '20231130');
    }
    public function testDate1CFormatOkt(){
        $year = new Year(2023);
        $month = new Month(10);
        $monthCalendar = new MonthCalendar($year, $month);
        $this->assertSame($monthCalendar->dateStartMonth1CFormat(), '20231001');
        $this->assertSame($monthCalendar->dateEndMonth1CFormat(), '20231031');
    }
    public function testDate1CFormatYn(){
        $year = new Year(2023);
        $month = new Month(1);
        $monthCalendar = new MonthCalendar($year, $month);
        $this->assertSame($monthCalendar->dateStartMonth1CFormat(), '20230101');
        $this->assertSame($monthCalendar->dateEndMonth1CFormat(), '20230131');
    }
    public function testDays(){
        $year = new Year(2023);
        $testMonths = [
            [
                'month' => 1,
                'days' => 31,
            ],
            [
                'month' => 2,
                'days' => 28,
            ],
            [
                'month' => 3,
                'days' => 31,
            ],
            [
                'month' => 4,
                'days' => 30,
            ],
        ];
        foreach ($testMonths as $monthArr){
            $month = new Month($monthArr['month']);
            $monthCalendar = new MonthCalendar($year, $month);
            $this->assertSame($monthCalendar->days(), $monthArr['days']);
        }
    }
}
