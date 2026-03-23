<?php

namespace App\Service;

use GuzzleHttp\Client;

class WeatherService
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function fetch(): array
    {
        $response = $this->client->get('https://api.open-meteo.com/v1/forecast', [
            'query' => [
                'latitude'        => 51.22,
                'longitude'       => 4.40,
                'current_weather' => true,
            ],
        ]);

        $data    = json_decode($response->getBody()->getContents(), true);
        $current = $data['current_weather'] ?? [];

        return [
            'city'        => 'Antwerp',
            'temp'        => $current['temperature'] ?? null,
            'description' => $this->wmoDescription($current['weathercode'] ?? -1),
        ];
    }

    private function wmoDescription(int $code): string
    {
        $map = [
            0  => 'Clear sky',
            1  => 'Mainly clear',
            2  => 'Partly cloudy',
            3  => 'Overcast',
            45 => 'Fog',
            48 => 'Icy fog',
            51 => 'Light drizzle',
            53 => 'Moderate drizzle',
            55 => 'Dense drizzle',
            61 => 'Slight rain',
            63 => 'Moderate rain',
            65 => 'Heavy rain',
            71 => 'Slight snow',
            73 => 'Moderate snow',
            75 => 'Heavy snow',
            80 => 'Slight showers',
            81 => 'Moderate showers',
            82 => 'Violent showers',
            95 => 'Thunderstorm',
            96 => 'Thunderstorm with hail',
            99 => 'Thunderstorm with heavy hail',
        ];

        return $map[$code] ?? 'Unknown';
    }
}
