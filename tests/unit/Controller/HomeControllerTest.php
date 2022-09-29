<?php

declare(strict_types=1);

namespace DragonBe\AzureRedisCachingTests;

use DragonBe\AzureRedisCaching\Controller\HomeController;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\StreamInterface;

class HomeControllerTest extends TestCase
{
    /**
     * Tests that the home controller returns a status of
     * 204 No content
     *
     * @return void
     * @covers \DragonBe\AzureRedisCaching\Controller\HomeController::getHome
     */
    public function testHomeRespondsWithCorrectStatus(): void
    {
        $expectedStatus = 204;
        $request = $this->createStub(Request::class);
        $response = $this->createStub(Response::class);
        $response->method('withStatus')->willReturnSelf();
        $response->method('getStatusCode')->willReturn($expectedStatus);
        $homeController = new HomeController();
        $result = $homeController->getHome($request, $response);
        $this->assertInstanceOf(Response::class, $result);
        $this->assertSame($expectedStatus, $result->getStatusCode());
    }

    /**
     * Test to verify we are getting a pong response for our
     * ping request
     *
     * @return void
     * @covers \DragonBe\AzureRedisCaching\Controller\HomeController::getPing
     */
    public function testPingRespondsWithPong(): void
    {
        $expectedMessage = json_encode(['message' => 'pong']);
        $request = $this->createStub(Request::class);
        $response = $this->createStub(Response::class);
        $stream = $this->createStub(StreamInterface::class);
        $stream->method('getContents')->willReturn($expectedMessage);
        $response->method('withHeader')->willReturnSelf();
        $response->method('getBody')->willReturn($stream);
        $homeController = new HomeController();
        $result = $homeController->getPing($request, $response);
        $this->assertInstanceOf(Response::class, $result);
        $this->assertSame($expectedMessage, $result->getBody()->getContents());
    }
}
