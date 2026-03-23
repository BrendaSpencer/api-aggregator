<?php

use Slim\App;
use App\Controller\AggregationController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function (App $app) {
    $app->get('/api/aggregate', function (Request $request, Response $response, array $args) {
        $response->getBody()->write('Under Construction');
        return $response;
    });
};

// return function (App $app) {
//     $app->get('/api/aggregate', [AggregationController::class, 'aggregate']);

// };
