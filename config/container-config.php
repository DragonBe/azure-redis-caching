<?php
declare(strict_types=1);

use DragonBe\AzureRedisCaching\Controller\CustomerController;
use DragonBe\AzureRedisCaching\Controller\HomeController;

return [
    HomeController::class => Di\create(HomeController::class),
    CustomerController::class => Di\create(CustomerController::class),
];