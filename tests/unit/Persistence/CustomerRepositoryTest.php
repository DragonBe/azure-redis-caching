<?php

namespace DragonBe\AzureRedisCachingTests\Persistence;

use ArrayIterator;
use DragonBe\AzureRedisCaching\Adapter\RepositoryAdapterInterface;
use DragonBe\AzureRedisCaching\Model\AddressType;
use DragonBe\AzureRedisCaching\Model\ContactType;
use DragonBe\AzureRedisCaching\Persistence\CustomerRepository;
use Faker\Factory;
use PHPUnit\Framework\TestCase;
use SplObjectStorage;
use Traversable;

class CustomerRepositoryTest extends TestCase
{
    private const DATA_LOCALE = 'nl_BE';
    private const DATA_LIMIT = 5;

    /**
     * @return void
     * @covers \DragonBe\AzureRedisCaching\Persistence\CustomerRepository::__construct
     * @covers \DragonBe\AzureRedisCaching\Persistence\CustomerRepository::list
     */
    public function testCanListAllCustomers(): void
    {
        $persistenceAdapter = $this->createStub(RepositoryAdapterInterface::class);
        $persistenceAdapter->method('getCollection')->willReturn($this->createCustomerList());
        $customerRepository = new CustomerRepository($persistenceAdapter);
        $dataSet = $customerRepository->list();
        $this->assertCount(self::DATA_LIMIT, $dataSet);
    }

    /**
     * Generate a list of customer details for testing
     *
     * @return Traversable
     */
    private function createCustomerList(): Traversable
    {
        $data = new ArrayIterator();
        $faker = Factory::create(self::DATA_LOCALE);
        for ($i = 0; $i < self::DATA_LIMIT; $i++) {
            $dataEntry = [
                'id' => $faker->uuid(),
                'firstName' => $faker->firstName(),
                'lastName' => $faker->lastName(),
                'addresses' => [
                    [
                        'addressType' => AddressType::Shipping,
                        'streetAddress' => $faker->streetAddress(),
                        'postcode' => $faker->postcode(),
                        'city' => $faker->city(),
                        'country' => $faker->country(),
                    ],
                ],
                'contact' => [
                    [
                        'contactType' => ContactType::Personal,
                        'phone' => $faker->e164PhoneNumber(),
                        'email' => $faker->email(),
                    ],
                ],
            ];
            $data->append($dataEntry);
        }
        return $data;
    }
}