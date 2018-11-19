<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, PATCH, OPTIONS");

use Monolog\ErrorHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

require_once __DIR__ . "/../vendor/autoload.php";

ini_set('display_errors', 1);
error_reporting(-1);

try {
    $logger = new Logger('logger');
    $logger->pushHandler(new StreamHandler(__DIR__ . '/../storage/log/monolog.log', Logger::DEBUG));
    ErrorHandler::register($logger);
} catch (Exception $e) {
}

$app = new Silex\Application();
$application_env = getenv("APPLICATION_ENV") ?: null;

$app->register(new KeepMe\Config($application_env));
$app['debug'] = true;

$app->register(new JDesrosiers\Silex\Provider\CorsServiceProvider(), [
    "cors.allowOrigin" => "*",
]);

$app->options("{anything}", function () {
    return new \Symfony\Component\HttpFoundation\JsonResponse(null, 204);
})->assert("anything", ".*");

if (php_sapi_name() !== 'cli') {
    $app->run();
} else {
    return $app;
}

