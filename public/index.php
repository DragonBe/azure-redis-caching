<?php
declare(strict_types=1);

use DI\Bridge\Slim\Bridge;
use DI\Container;
use DI\ContainerBuilder;
use DragonBe\AzureRedisCaching\Controller\CustomerController;
use DragonBe\AzureRedisCaching\Controller\HomeController;
use Slim\Factory\AppFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$builder = new ContainerBuilder();
$builder->addDefinitions(__DIR__ . '/../config/container-config.php');
$container = $builder->build();

$app = Bridge::create($container);

$app->get('/', [HomeController::class, 'getHome'])->setName('home');
$app->get('/ping', [HomeController::class, 'getPing'])->setName('ping');
$app->get('/customer', [CustomerController::class, 'getCustomer'])->setName('get-customer-list');

$app->run();