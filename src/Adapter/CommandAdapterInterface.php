<?php

namespace DragonBe\AzureRedisCaching\Adapter;

interface CommandAdapterInterface
{
    /**
     * Create a new entry in the storage
     *
     * @param array $data
     * @return array
     */
    public function create(array $data): array;

    /**
     * Update an existing entry in the storage
     *
     * @param string $referenceField
     * @param string $referenceId
     * @param array $data
     * @return array
     */
    public function update(string $referenceField, string $referenceId, array $data): array;
}
