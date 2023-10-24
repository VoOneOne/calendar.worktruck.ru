<?php

use GuzzleHttp\Client;
use Mirall\CalendarWorktruckRu\Domain\ArrowLinks;
use Mirall\CalendarWorktruckRu\Domain\MonthCalendar;
use Mirall\CalendarWorktruckRu\MoneyCalendar\MoneyCalendar;
use Mirall\CalendarWorktruckRu\MoneyCalendar\MoneyData;
use Mirall\CalendarWorktruckRu\SubDomain\Month;
use Mirall\CalendarWorktruckRu\SubDomain\Year;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require __DIR__ . '/../vendor/autoload.php';


// Instantiate App
$app = AppFactory::create();

// Add error middleware
$app->addErrorMiddleware(true, true, true);



$app->get('/calendar/{year}/{month}', function (Request $request, Response $response, $args) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->load();
    $year = new Year($args['year']);
    $month = new Month($args['month']);
    $monthTable = new MonthCalendar($year, $month);
    $client = new Client();
    $response1C = $client->post(
        'http://192.168.0.223/test/hs/our-1c/getfin',
        [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode([
                'datestart' => $monthTable->dateStartMonth1CFormat(),
                'dateend' => $monthTable->dateEndMonth1CFormat(),
            ])
        ]
    );
    $jsonMoneyData = $response1C->getBody()->getContents();
    $arrayMoneyData = json_decode($jsonMoneyData, true);
    $moneyData = new MoneyData($arrayMoneyData, $year, $month);
    $moneyCalendar = new MoneyCalendar($monthTable, $moneyData);

    $arrowLinks = new ArrowLinks($year, $month);
    $twigArray = [
        'arrow' => [
            'left' => [
                'link' => $arrowLinks->previousMonthLink()
            ],
            'right' => [
                'link' => $arrowLinks->nextMonthLink()
            ]
        ],
        'monthName' => $month->name(),
        'calendarTable' => $moneyCalendar->array()
    ];
    $loader = new FilesystemLoader('templates');
    $twig = new Environment($loader);
    $html = $twig->render('month_calendar.twig', $twigArray);
    $response->getBody()->write($html);
    return $response;
});


$app->run();