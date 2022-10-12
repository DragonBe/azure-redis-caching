<?php

namespace DragonBe\AzureRedisCachingTests\Service;

use ArrayIterator;
use DragonBe\AzureRedisCaching\Model\CustomerInterface;
use DragonBe\AzureRedisCaching\Persistence\CommandInterface;
use DragonBe\AzureRedisCaching\Persistence\CustomerCommand;
use DragonBe\AzureRedisCaching\Persistence\CustomerRepository;
use DragonBe\AzureRedisCaching\Persistence\RepositoryInterface;
use DragonBe\AzureRedisCaching\Service\CustomerService;
use Faker\Factory;
use Laminas\Hydrator\HydratorInterface;
use PHPUnit\Framework\TestCase;
use Traversable;

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

    /**
     * Test that all customers can be retrieved from the repository
     * using the service.
     *
     * @return void
     * @covers \DragonBe\AzureRedisCaching\Service\CustomerService::__construct
     * @covers \DragonBe\AzureRedisCaching\Service\CustomerService::getCustomerList
     */
    public function testServiceCanListAllCustomers(): void
    {
        $expectedData = new ArrayIterator([
            [
                'name' => 'foo',
            ],
            [
                'name' => 'bar',
            ],
            [
                'name' => 'baz',
            ],
        ]);
        $customerRepository = $this->createStub(CustomerRepository::class);
        $customerRepository->method('list')->willReturn($expectedData);
        $customerCommand = $this->createStub(CustomerCommand::class);
        $hydrator = $this->createStub(HydratorInterface::class);
        $customer = $this->createStub(CustomerInterface::class);

        $customerService = new CustomerService(
            $customerRepository,
            $customerCommand,
            $hydrator,
            $customer
        );
        $result = $customerService->getCustomerList();
        $this->assertInstanceOf(Traversable::class, $result);
        $this->assertCount(count($expectedData), $result);
    }
}
