<?php

namespace MoneyCalendar;

use Mirall\CalendarWorktruckRu\MoneyCalendar\MoneyData;
use Mirall\CalendarWorktruckRu\SubDomain\Day;
use Mirall\CalendarWorktruckRu\SubDomain\Month;
use Mirall\CalendarWorktruckRu\SubDomain\Year;
use PHPUnit\Framework\TestCase;

class MoneyDataTest extends TestCase
{
    public function test(){
        $json = '{
"rasplan": [
{
"sum": "3558319,7",
"date": "02.10.2023 0:00:00"
},
{
"sum": "451135,3",
"date": "03.10.2023 0:00:00"
},
{
"sum": "1797",
"date": "04.10.2023 0:00:00"
},
{
"sum": "7351,64",
"date": "05.10.2023 0:00:00"
},
{
"sum": "4089",
"date": "06.10.2023 0:00:00"
},
{
"sum": "20884,1",
"date": "09.10.2023 0:00:00"
},
{
"sum": "2917000",
"date": "17.10.2023 0:00:00"
}
],
"rasfact": [
{
"sum": "2880379,12",
"date": "02.10.2023 0:00:00"
}
],
"prihplan": [],
"prihfact": [
{
"sum": "75000",
"date": "01.10.2023 0:00:00"
},
{
"sum": "932550",
"date": "02.10.2023 0:00:00"
}
]
}';
        $array = json_decode($json, true);
        $moneyData = new MoneyData($array, new Year(2023), new Month(10));
        $dayMoney = $moneyData->day(new Day(2));
        $this->assertEquals($dayMoney->array(), ['day' => 2, 'rasplan' => intval("3558319,7"), "prihfact" => intval("932550"), "rasfact" => intval("2880379,12")]);
    }
}
