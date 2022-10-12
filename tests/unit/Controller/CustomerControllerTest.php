<?php

declare(strict_types=1);

namespace DragonBe\AzureRedisCachingTests\Controller;

use DragonBe\AzureRedisCaching\Controller\CustomerController;
use DragonBe\AzureRedisCaching\Service\CustomerService;
use Faker\Factory;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\StreamInterface;

class CustomerControllerTest extends TestCase
{
    private string $customerList;

    protected function setUp(): void
    {
        parent::setUp();
        $this->customerList = $this->createCustomerList();
    }

    /**
     * Test that we can retrieve a list of customers, limited to 10
     * entries max.
     *
     * @return void
     * @covers \DragonBe\AzureRedisCaching\Controller\CustomerController::__construct
     * @covers \DragonBe\AzureRedisCaching\Controller\CustomerController::getCustomer
     */
    public function testCanListCustomers(): void
    {
        $streamStub = $this->createStub(StreamInterface::class);
        $streamStub->method('getContents')->willReturn($this->customerList);
        $streamStub->method('write')->willReturnSelf();
        $requestStub = $this->createStub(Request::class);
        $responseStub = $this->createStub(Response::class);
        $responseStub->method('getBody')->willReturn($streamStub);
        $responseStub->method('withHeader')->willReturnSelf();

        $customerService = $this->createStub(CustomerService::class);

        $customerController = new CustomerController($customerService);
        $response = $customerController->getCustomer($requestStub, $responseStub);
        $this->assertInstanceOf(Response::class, $response);
        $actualCustomerData = json_decode($response->getBody()->getContents(), true);
        $this->assertCount(10, $actualCustomerData);
    }

    /**
     * Create a generated list of customers for testing purposes
     *
     * @param int $elements
     * @return string
     */
    private function createCustomerList(int $elements = 10): string
    {
        $faker = Factory::create('nl_BE');
        $data = [];
        for ($i = 0; $i < $elements; $i++) {
            $customer = [
                'page' => 1,
                'totalPages' => 245,
                'id' => $faker->uuid(),
                'firstName' => substr($faker->firstName(), 0, 1) . '.',
                'lastName' => $faker->lastName(),
                'addresses' => [
                    'addressType' => 'shipping',
                    'streetAddress' => $faker->streetAddress(),
                    'postcode' => $faker->postcode(),
                    'city' => $faker->city(),
                    'country' => 'België',
                ],
                'contact' => [
                    'contactType' => $faker->randomElement(['Personal']),
                    'phone' => $faker->e164PhoneNumber(),
                    'email' => $faker->email(),
                ],
            ];
            $data[] = $customer;
        }
        return json_encode($data, JSON_PRETTY_PRINT);
    }
}
