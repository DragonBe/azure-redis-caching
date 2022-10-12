<?php
declare(strict_types=1);

use DragonBe\AzureRedisCaching\Adapter\CommandAdapterInterface;
use DragonBe\AzureRedisCaching\Adapter\CommandFileAdapter;
use DragonBe\AzureRedisCaching\Adapter\RepositoryAdapterInterface;
use DragonBe\AzureRedisCaching\Adapter\RepositoryFileAdapter;
use DragonBe\AzureRedisCaching\Controller\CustomerController;
use DragonBe\AzureRedisCaching\Controller\HomeController;
use DragonBe\AzureRedisCaching\Model\Customer;
use DragonBe\AzureRedisCaching\Model\CustomerInterface;
use DragonBe\AzureRedisCaching\Persistence\CustomerCommand;
use DragonBe\AzureRedisCaching\Persistence\CustomerRepository;
use DragonBe\AzureRedisCaching\Service\CustomerService;
use Laminas\Hydrator\HydratorInterface;
use Laminas\Hydrator\ReflectionHydrator;
use Psr\Container\ContainerInterface;

defined('CUSTOMER_SOURCE')
    || define('CUSTOMER_SOURCE', __DIR__ . '/../data/customers.json');

return [
    // Adapters
    RepositoryFileAdapter::class => DI\create()->constructor(CUSTOMER_SOURCE),
    CommandFileAdapter::class => DI\create()->constructor(CUSTOMER_SOURCE),

    // Interfaces
    HydratorInterface::class => DI\create(ReflectionHydrator::class),
    RepositoryAdapterInterface::class => DI\get(RepositoryFileAdapter::class),
    CommandAdapterInterface::class => DI\get(CommandFileAdapter::class),
    CustomerInterface::class => DI\create(Customer::class),

    // Factories
    CustomerRepository::class => DI\factory(function (ContainerInterface $container) {
        return new CustomerRepository($container->get(RepositoryAdapterInterface::class));
    }),
    CustomerCommand::class => DI\factory(function (ContainerInterface $container) {
        return new CustomerCommand($container->get(CommandAdapterInterface::class));
    }),

    // Services
    CustomerService::class => DI\factory(function (ContainerInterface $container) {
        return new CustomerService(
            $container->get(CustomerRepository::class),
            $container->get(CustomerCommand::class),
            $container->get(HydratorInterface::class),
            $container->get(CustomerInterface::class)
        );
    }),

    // Controllers
    HomeController::class => DI\create(HomeController::class),
    CustomerController::class => DI\factory(function (ContainerInterface $container){
        return new CustomerController($container->get(CustomerService::class));
    }),
];