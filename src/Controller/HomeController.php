<?php

declare(strict_types=1);

namespace DragonBe\AzureRedisCaching\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController extends BaseController
{
    /**
     * Provide an empty action for the root endpoint
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function getHome(Request $request, Response $response): Response
    {
        return $response->withStatus(204);
    }

    /**
     * A quick standard endpoint for health checks
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function getPing(Request $request, Response $response): Response
    {
        $response->getBody()->write(json_encode(['message' => 'pong']));
        return $response->withHeader('Content-Type', parent::DEFAULT_CONTENT_TYPE);
    }
}
