<?php

namespace DragonBe\AzureRedisCachingTests\Service;

use DragonBe\AzureRedisCaching\Model\CustomerInterface;
use DragonBe\AzureRedisCaching\Persistence\CommandInterface;
use DragonBe\AzureRedisCaching\Persistence\RepositoryInterface;
use DragonBe\AzureRedisCaching\Service\CustomerService;
use Faker\Factory;
use Laminas\Hydrator\HydratorInterface;
use PHPUnit\Framework\TestCase;

class CustomerServiceTest extends TestCase
{
    /**
     * Test that the service can create a new customer
     *
     * @covers \DragonBe\AzureRedisCaching\Service\CustomerService::__construct
     * @covers \DragonBe\AzureRedisCaching\Service\CustomerService::createCustomer
     */
    public function testServiceCanCreateNewCustomer(): void
    {
        $repository = $this->createStub(RepositoryInterface::class);
        $command = $this->createStub(CommandInterface::class);
        $hydrator = $this->createStub(HydratorInterface::class);
        $customer = $this->createStub(CustomerInterface::class);

        $faker = Factory::create('nl_BE');
        $customerData = [
            'id' => $faker->uuid(),
            'firstName' => $faker->firstName(),
            'lastName' => $faker->lastName(),
        ];
        $customerService = new CustomerService($repository, $command, $hydrator, $customer);
        $result = $customerService->createCustomer($customerData);
        $this->assertInstanceOf(CustomerInterface::class, $result);
    }
}
