<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiTest extends WebTestCase
{
    public function testUnknownCurrency(): void
    {
        self::assertSame(Response::HTTP_NOT_FOUND, $this->call('CHF', 10)->getStatusCode());
    }

    /**
     * @dataProvider impossible
     */
    public function testImpossibleChange(string $currency, float $amount): void
    {
        self::assertSame(Response::HTTP_BAD_REQUEST, $this->call($currency, $amount)->getStatusCode());
    }

    /**
     * @dataProvider valid
     */
    public function testValidChange(string $currency, float $amount, string $expectedJson): void
    {
        $response = $this->call($currency, $amount);
        self::assertSame(Response::HTTP_OK, $response->getStatusCode());
        self::assertSame(json_encode(json_decode($expectedJson)), $response->getContent());
    }

    public function call(string $currency, float $amount): Response
    {
        $client = self::createClient();
        $client->request(
            Request::METHOD_GET,
            "/api/$currency/change/$amount",
            [],
            [],
            ['HTTP_ACCEPT' => 'application/json']
        );

        return $client->getResponse();
    }

    public function impossible(): Generator
    {
        yield 'Impossible change of -1€' => ['EUR', -1];
        yield 'Impossible change of 0.005€' => ['EUR', 0.005];
        yield 'Impossible change of -1¥' => ['JPY', -1];
        yield 'Impossible change of -0.5¥' => ['JPY', 0.5];
    }

    public function valid(): Generator
    {
        yield 'Valid change of 728.93€' => [
            'EUR',
            728.93,
            <<<JSON
{
    "currency": "€",
    "envelope": [
        [500, 1],
        [200, 1],
        [20, 1],
        [5, 1],
        [2, 1],
        [1, 1],
        [0.50, 1],
        [0.20, 2],
        [0.02, 1],
        [0.01, 1]
    ]
}
JSON
        ];
        yield 'Valid change of 13 843¥' => [
            'JPY',
            13843,
            <<<JSON
{
    "currency": "¥",
    "envelope": [
        [10000, 1],
        [2000, 1],
        [1000, 1],
        [500, 1],
        [100, 3],
        [10, 4],
        [1, 3]
    ]
}
JSON
        ];
    }
}
