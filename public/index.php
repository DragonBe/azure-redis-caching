<?php
declare(strict_types=1);

use DI\Container;
use DragonBe\AzureRedisCaching\Controller\HomeController;
use Slim\Factory\AppFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$container = new Container();

$container->set(HomeController::class, new HomeController());

AppFactory::setContainer($container);
$app = AppFactory::create();

$app->get('/', [HomeController::class, 'getHome'])->setName('home');
$app->get('/ping', [HomeController::class, 'getPing'])->setName('ping');

$app->run();