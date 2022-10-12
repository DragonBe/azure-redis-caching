<?php

namespace DragonBe\AzureRedisCaching\Persistence;

interface CommandInterface
{
    /**
     * Create a new entity and persist it in the data storage.
     *
     * @param array $data
     * @return array
     */
    public function create(array $data = []): array;

    /**
     * Update an existing entity by its reference ID and changed
     * fields.
     *
     * @param string $referenceId
     * @param array $data
     * @return array
     */
    public function update(string $referenceId, array $data = []): array;
}