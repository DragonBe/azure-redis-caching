<?php

namespace DragonBe\AzureRedisCaching\Persistence;

use ArrayIterator;
use DragonBe\AzureRedisCaching\Adapter\RepositoryAdapterInterface;
use Traversable;

class CustomerRepository
{
    private RepositoryAdapterInterface $repositoryAdapter;

    /**
     * @param RepositoryAdapterInterface $repositoryAdapter
     */
    public function __construct(RepositoryAdapterInterface $repositoryAdapter)
    {
        $this->repositoryAdapter = $repositoryAdapter;
    }

    /**
     * Return a list of customers
     *
     * @return Traversable
     */
    public function list(): Traversable
    {
        $query = 'SELECT * FROM customer';
        return $this->repositoryAdapter->getCollection($query);
    }
}