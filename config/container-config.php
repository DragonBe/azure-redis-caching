<?php
declare(strict_types=1);

use DragonBe\AzureRedisCaching\Adapter\RepositoryAdapterInterface;
use DragonBe\AzureRedisCaching\Controller\CustomerController;
use DragonBe\AzureRedisCaching\Controller\HomeController;
use DragonBe\AzureRedisCaching\Persistence\CustomerRepository;

return [
    RepositoryAdapterInterface::class => Di\create(RepositoryAdapter::class),
    CustomerRepository::class => Di\create(CustomerRepository::class),
    HomeController::class => Di\create(HomeController::class),
    CustomerController::class => Di\create(CustomerController::class),
];