<?php

namespace DragonBe\AzureRedisCaching\Persistence;

use DragonBe\AzureRedisCaching\Adapter\CommandAdapterInterface;

class CustomerCommand
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
     * Store a new customer in the persistence layer
     *
     * @param array $data
     * @return array
     */
    public function createCustomer(array $data)
    {
        return $this->commandAdapter->create($data);
    }
}