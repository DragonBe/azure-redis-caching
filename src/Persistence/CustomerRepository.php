<?php

namespace DragonBe\AzureRedisCaching\Persistence;

use ArrayIterator;
use DragonBe\AzureRedisCaching\Adapter\RepositoryAdapterInterface;
use Traversable;

class CustomerRepository implements RepositoryInterface
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
     * @inheritDoc
     */
    public function list(): Traversable
    {
        $query = 'SELECT * FROM customer';
        return $this->repositoryAdapter->getCollection($query);
    }

    /**
     * @inheritDoc
     */
    public function entity(string $referenceId = ''): array
    {
        $query = 'SELECT * FROM customer WHERE customerUuid = :referenceId';
        $params = [
            [
                'key' => 'referenceId',
                'value' => $referenceId,
                'type' => RepositoryInterface::DATA_TYPE_STRING,
            ],
        ];
        return $this->repositoryAdapter->getEntity($query, $params);
    }
}