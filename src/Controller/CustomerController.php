<?php

declare(strict_types=1);

namespace DragonBe\AzureRedisCaching\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CustomerController extends BaseController
{
    private const CUSTOMER_RAW_DATA = __DIR__ . '/../../data/customers.json';

    public function getCustomer(Request $request, Response $response): Response
    {
        $data = file_get_contents(self::CUSTOMER_RAW_DATA);
        $response->getBody()->write($data);
        return $response->withHeader('Content-Type', 'application/json');
    }
}
