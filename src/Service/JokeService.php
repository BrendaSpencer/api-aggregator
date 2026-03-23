<?php

namespace App\Service;

use GuzzleHttp\Client;

class JokeService
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function fetch(): string
    {
        $response = $this->client->get('https://v2.jokeapi.dev/joke/Programming', [
            'query' => ['type' => 'single'],
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        return $data['joke'] ?? 'No joke today.';
    }
}
