<?php

namespace DragonBe\AzureRedisCaching\Adapter;

use Traversable;

interface RepositoryAdapterInterface
{
    /**
     * Retrieve a collection of entities from the persistent storage
     *
     * @param string $query
     * @param array $arguments
     * @return Traversable
     */
    public function getCollection(string $query, array $arguments = []): Traversable;

    /**
     * Retrieve a single entity from the persistent storage
     *
     * @param string $referenceId
     * @param array $arguments
     * @return array
     */
    public function getEntity(string $referenceId, array $arguments = []): array;
}
