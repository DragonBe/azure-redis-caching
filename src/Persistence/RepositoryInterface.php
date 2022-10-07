<?php

namespace DragonBe\AzureRedisCaching\Persistence;

use Traversable;

interface RepositoryInterface
{
    public const DATA_TYPE_INT = 1;
    public const DATA_TYPE_STRING = 2;

    /**
     * Retrieve a list of repository entities
     *
     * @return Traversable
     */
    public function list(): Traversable;

    /**
     * Retrieve a single entity if it exists
     *
     * @return array
     */
    public function entity(): array;
}