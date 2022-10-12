<?php

namespace DragonBe\AzureRedisCaching\Service;

use DragonBe\AzureRedisCaching\Model\CustomerInterface;
use DragonBe\AzureRedisCaching\Persistence\CommandInterface;
use DragonBe\AzureRedisCaching\Persistence\RepositoryInterface;
use Laminas\Hydrator\HydratorInterface;

class CustomerService
{
    private RepositoryInterface $customerRepository;
    private CommandInterface $customerCommand;
    private HydratorInterface $hydrator;
    private CustomerInterface $customer;

    /**
     * @param RepositoryInterface $customerRepository
     * @param CommandInterface $customerCommand
     * @param HydratorInterface $hydrator
     * @param CustomerInterface $customer
     */
    public function __construct(
        RepositoryInterface $customerRepository,
        CommandInterface $customerCommand,
        HydratorInterface $hydrator,
        CustomerInterface $customer
    ) {
        $this->customerRepository = $customerRepository;
        $this->customerCommand = $customerCommand;
        $this->hydrator = $hydrator;
        $this->customer = $customer;
    }

    public function createCustomer(array $customerData): CustomerInterface
    {
        return $this->customer;
    }
}