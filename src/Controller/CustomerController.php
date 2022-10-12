<?php

declare(strict_types=1);

namespace DragonBe\AzureRedisCaching\Controller;

use ArrayIterator;
use DragonBe\AzureRedisCaching\Service\CustomerService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CustomerController extends BaseController
{
    private const CUSTOMER_RAW_DATA = __DIR__ . '/../../data/customers.json';
    private CustomerService $customerService;

    /**
     * @param CustomerService $customerService
     */
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function getCustomer(Request $request, Response $response): Response
    {
        $customerList = $this->customerService->getCustomerList();
        $data = json_encode((array) $customerList, JSON_PRETTY_PRINT);
        $response->getBody()->write($data);
        return $response->withHeader('Content-Type', parent::DEFAULT_CONTENT_TYPE);
    }
}
