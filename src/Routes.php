<?php

use Slim\App;
use App\Controller\AggregationController;

return function (App $app) {
    $app->get('/api/aggregate', [AggregationController::class, 'aggregate']);
};
