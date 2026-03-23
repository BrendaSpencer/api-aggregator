 <?php


use Slim\Factory\AppFactory;
use Dotenv\Dotenv;
// use Psr\Http\Message\ResponseInterface as Response;
// use Psr\Http\Message\ServerRequestInterface as Request;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$container = require __DIR__ . '/../config/container.php';
AppFactory::setContainer($container);

$app = AppFactory::create();
$app->addBodyParsingMiddleware();
$app->addErrorMiddleware(true, true, true);

(require __DIR__ . '/../src/Routes.php')($app);

$app->run();






// $app = AppFactory::create();

// $app->get('/', function (Request $request, Response $response, array $args) {
//     $response->getBody()->write('Under Construction');
// });


// $app->run(); 