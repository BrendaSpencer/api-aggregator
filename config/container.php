<?php

use DI\Container;
use GuzzleHttp\Client;

$container = new Container();

$container->set(Client::class, function () {
    return new Client([
        'timeout' => 5,
        'http_errors' => false,
    ]);
});

return $container;
