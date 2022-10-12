<?php

namespace DragonBe\AzureRedisCaching\Persistence;

use DragonBe\AzureRedisCaching\Adapter\CommandAdapterInterface;

class CustomerCommand implements CommandInterface
{
    private CommandAdapterInterface $commandAdapter;

    /**
     * @param CommandAdapterInterface $commandAdapter
     */
    public function __construct(CommandAdapterInterface $commandAdapter)
    {
        $this->commandAdapter = $commandAdapter;
    }

    /**
     * @inheritDoc
     */
    public function create(array $data = []): array
    {
        return $this->commandAdapter->create($data);
    }

    /**
     * @inheritDoc
     */
    public function update(string $referenceId, array $data = []): array
    {
        return $data;
    }

}