<?php

namespace DragonBe\AzureRedisCaching\Adapter;

use ArrayIterator;
use DragonBe\AzureRedisCaching\Exception\EntityNotFoundException;
use InvalidArgumentException;
use Traversable;

class RepositoryFileAdapter implements RepositoryAdapterInterface
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
        return new ArrayIterator($this->retrieveData());
    }

    /**
     * @inheritDoc
     */
    public function getEntity(string $referenceId, array $arguments = []): array
    {
        $data = $this->retrieveData();
        $resultSet = array_filter($data, function (array $val) use ($referenceId): bool {
            if (!isset($val['name'])) {
                throw new InvalidArgumentException(sprintf(
                    'This resource does not have a reference %s, is it the correct one?',
                    'name',
                ));
            }
            return ($val['name'] === $referenceId);
        });
        if ([] === $resultSet) {
            throw new EntityNotFoundException(sprintf(
                'There is no entity found with reference %s',
                $referenceId
            ));
        }
        return (array) array_shift($resultSet);
    }

    private function retrieveData(): array
    {
        $data = file_get_contents($this->source);
        return (array) json_decode($data, true);
    }
}
