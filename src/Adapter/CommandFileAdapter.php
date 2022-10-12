<?php

declare(strict_types=1);

namespace DragonBe\AzureRedisCaching\Adapter;

use InvalidArgumentException;
use Throwable;

class CommandFileAdapter implements CommandAdapterInterface
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
    public function create(array $data): array
    {
        return $this->writeToFile($data);
    }

    /**
     * @inheritDoc
     */
    public function update(string $referenceField, string $referenceId, array $data): array
    {
        return $this->writeToFile($data, $referenceField, $referenceId);
    }

    /**
     * Functionality to persist the data in the file
     *
     * @param array $data
     * @return array
     */
    private function writeToFile(array $data, string $referenceField = '', string $referenceId = ''): array
    {
        if ('' !== $referenceField && '' !== $referenceId) {
            return $this->updateFile($referenceField, $referenceId, $data);
        }
        return $this->appendToFile($data);
    }

    /**
     * Append new data to the end of a file
     *
     * @param array $data
     * @return array
     */
    private function appendToFile(array $data): array
    {
        $jsonData = file_get_contents($this->source);
        $existingData = json_decode($jsonData, true);
        $existingData[] = $data;
        file_put_contents($this->source, json_encode($existingData));
        return $existingData;
    }

    /**
     * Update existing data in the file
     *
     * @param string $referenceField
     * @param string $referenceId
     * @param array $data
     * @return array
     */
    private function updateFile(string $referenceField, string $referenceId, array $data): array
    {
        $jsonData = file_get_contents($this->source);
        $existingData = json_decode($jsonData, true);
        $dataSize = count($existingData);
        for ($i = 0; $i < $dataSize; $i++) {
            if ($existingData[$i][$referenceField] === $referenceId) {
                $existingData[$i] = $data;
            }
        }
        return $existingData;
    }
}
