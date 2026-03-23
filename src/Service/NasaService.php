<?php

namespace App\Service;

use GuzzleHttp\Client;

class NasaService
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function fetch(): array
    {
        $apiKey = $_ENV['NASA_API_KEY'] ?? 'DEMO_KEY';

        $response = $this->client->get('https://api.nasa.gov/planetary/apod', [
            'query' => ['api_key' => $apiKey],
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        return [
            'title'       => $data['title'] ?? null,
            'image_url'   => $data['url'] ?? null,
            'explanation' => $data['explanation'] ?? null,
        ];
    }
}
