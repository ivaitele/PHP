<?php

use Appsas\Authenticator;
use Appsas\Controllers\AdminController;
use Appsas\Controllers\KontaktaiController;
use Appsas\Controllers\PersonController;
use Appsas\Controllers\PradziaController;
use Appsas\ExceptionHandler;
use Appsas\Output;
use Appsas\Router;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/larapack/dd/src/helper.php';

$log = new Logger('Portfolios');
$log->pushHandler(new StreamHandler('../logs/klaidos.log', Logger::INFO));

$output = new Output();

try {
    session_start();

    $authenticator = new Authenticator();
    $adminController = new AdminController($authenticator);
    $kontaktaiController = new KontaktaiController($log);

    $router = new Router();
    $router->addRoute('GET', '', [new PradziaController(), 'index']);
    $router->addRoute('GET', 'admin', [$adminController, 'index']);
    $router->addRoute('POST', 'login', [$adminController, 'login']);
    $router->addRoute('GET', 'kontaktai', [$kontaktaiController, 'index']);
    $router->addRoute('GET', 'persons', [new PersonController(), 'index']);
    $router->addRoute('GET', 'persons/new', [new PersonController(), 'new']);
    $router->addRoute('POST', 'persons', [new PersonController(), 'postNew']);
    $router->addRoute('GET', 'persons/delete', [new PersonController(), 'delete']);
    $router->addRoute('GET', 'persons/edit', [new PersonController(), 'edit']);
    $router->addRoute('POST', 'persons/edit', [new PersonController(), 'postEdit']);
    $router->addRoute('GET', 'logout', [$adminController, 'logout']);
    $router->run();
}
catch (Exception $e) {
    $handler = new ExceptionHandler($output, $log);
    $handler->handle($e);
}

// Spausdinam viska kas buvo 'Storinta' Output klaseje
$output->print();
