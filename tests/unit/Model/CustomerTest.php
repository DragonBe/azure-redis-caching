<?php

declare(strict_types=1);

namespace DragonBe\AzureRedisCachingTests\Model;

use DragonBe\AzureRedisCaching\Model\AddressInterface;
use DragonBe\AzureRedisCaching\Model\AddressType;
use DragonBe\AzureRedisCaching\Model\ContactInterface;
use DragonBe\AzureRedisCaching\Model\ContactType;
use DragonBe\AzureRedisCaching\Model\Customer;
use DragonBe\AzureRedisCaching\Model\CustomerInterface;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
    /**
     * Test that we can provision our model at construct
     *
     * @return void
     * @covers \DragonBe\AzureRedisCaching\Model\Customer::__construct
     * @covers \DragonBe\AzureRedisCaching\Model\Customer::getId
     * @covers \DragonBe\AzureRedisCaching\Model\Customer::getFirstName
     * @covers \DragonBe\AzureRedisCaching\Model\Customer::getLastName
     * @covers \DragonBe\AzureRedisCaching\Model\Customer::getAddresses
     * @covers \DragonBe\AzureRedisCaching\Model\Customer::getContact
     */
    public function testCanProvisionCustomerWithData(): void
    {
        $dataSet = [
            'id' => 'd30790f0-efcb-398b-b792-1cae34d52c37',
            'firstName' => 'Stan',
            'lastName' => 'Leroy',
            'addresses' => [
                [
                    'addressType' => AddressType::Shipping,
                    'streetAddress' => 'Dethierhof 81',
                    'postcode' => '1790',
                    'city' => 'Chi\u00e8vres',
                    'country' => 'Belgi\u00eb',
                ],
            ],
            'contact' => [
                [
                    'contactType' => ContactType::Personal,
                    'phone' => '+237404568923',
                    'email' => 'adrien71@claes.com',
                ],
            ],
        ];
        $addressStub = $this->createStub(AddressInterface::class);
        $contactStub = $this->createStub(ContactInterface::class);

        $customer = new Customer(
            $dataSet['id'],
            $dataSet['firstName'],
            $dataSet['lastName'],
            [$addressStub],
            [$contactStub],
        );
        $this->assertInstanceOf(CustomerInterface::class, $customer);
        $this->assertSame($dataSet['id'], $customer->getId());
        $this->assertSame($dataSet['firstName'], $customer->getFirstName());
        $this->assertSame($dataSet['lastName'], $customer->getLastName());
        $this->assertCount(1, $customer->getAddresses());
        $this->assertCount(1, $customer->getContact());
    }
}
