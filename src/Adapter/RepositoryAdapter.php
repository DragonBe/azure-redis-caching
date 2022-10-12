<?php

namespace DragonBe\AzureRedisCaching\Adapter;

use ArrayIterator;
use Traversable;

class RepositoryAdapter implements RepositoryAdapterInterface
{
    private string $source;

    /**
     * @param string $source
     */
    public function __construct(string $source)
    {
        $this->source = $source;
    }

    /**
     * @inheritDoc
     */
    public function getCollection(string $query, array $arguments = []): Traversable
    {
        return new ArrayIterator();
    }

    /**
     * @inheritDoc
     */
    public function getEntity(string $query, array $arguments = []): array
    {
        return [];
    }
}