<?php

namespace DragonBe\AzureRedisCachingTests\Persistence;

use DragonBe\AzureRedisCaching\Adapter\CommandAdapterInterface;
use DragonBe\AzureRedisCaching\Model\AddressType;
use DragonBe\AzureRedisCaching\Model\ContactType;
use DragonBe\AzureRedisCaching\Persistence\CustomerCommand;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class CutomerCommandTest extends TestCase
{
    private const DEFAULT_LOCALE = 'nl_BE';

    /**
     * Test that we can create a new customer
     *
     * @return void
     * @covers \DragonBe\AzureRedisCaching\Persistence\CustomerCommand::__construct
     * @covers \DragonBe\AzureRedisCaching\Persistence\CustomerCommand::createCustomer
     */
    public function testCustomerEntityCanBeCreated(): void
    {
        $data = $this->createCustomerData();
        $commandAdapter = $this->createStub(CommandAdapterInterface::class);
        $commandAdapter->method('create')->willReturn($data);
        $customerCommand = new CustomerCommand($commandAdapter);
        $result = $customerCommand->createCustomer($data);
        $this->assertSame($data['id'], $result['id']);
        $this->assertSame($data['firstName'], $result['firstName']);
        $this->assertSame($data['lastName'], $result['lastName']);
    }

    /**
     * Create random generated customer data
     *
     * @return array
     */
    private function createCustomerData(): array
    {
        $faker = Factory::create(self::DEFAULT_LOCALE);
        return [
            'id' => $faker->uuid(),
            'firstName' => $faker->firstName(),
            'lastName' => $faker->lastName(),
            'addresses' => [
                [
                    'addressType' => AddressType::Shipping,
                    'streetAddress' => $faker->streetAddress(),
                    'postcode' => $faker->postcode(),
                    'city' => $faker->city(),
                    'country' => 'België',
                ],
            ],
            'contact' => [
                [
                    'contactType' => ContactType::Personal,
                    'phone' => $faker->phoneNumber(),
                    'email' => $faker->email(),
                ],
            ],
        ];
    }
}