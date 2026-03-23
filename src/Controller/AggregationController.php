<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Service\WeatherService;
use App\Service\NasaService;
use App\Service\JokeService;
use GuzzleHttp\Client;

class AggregationController
{
    public function aggregate(Request $request, Response $response): Response
    {
        $client = new Client(['timeout' => 5, 'http_errors' => false]);

        $data = [
            'date'    => date('Y-m-d'),
            'weather' => $this->tryFetch(fn() => (new WeatherService($client))->fetch()),
            'space'   => $this->tryFetch(fn() => (new NasaService($client))->fetch()),
            'joke'    => $this->tryFetch(fn() => (new JokeService($client))->fetch()),
        ];

        $response->getBody()->write(json_encode($data, JSON_PRETTY_PRINT));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Access-Control-Allow-Origin', '*');
    }

    private function tryFetch(callable $fn): mixed
    {
        try {
            return $fn();
        } catch (\Throwable $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
