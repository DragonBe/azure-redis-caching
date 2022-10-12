<?php

declare(strict_types=1);

namespace DragonBe\AzureRedisCachingTests\Adapter;

use DragonBe\AzureRedisCaching\Adapter\RepositoryFileAdapter;
use DragonBe\AzureRedisCaching\Exception\EntityNotFoundException;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Traversable;

class RepositoryFileAdapterTest extends TestCase
{
    private const TEST_SOURCE = __DIR__ . '/../_files/user-collection.json';
    private const TEST_WRONG_SOURCE = __DIR__ . '/../_files/wrong-collection.json';
    private const TEST_ENTRY_COUNT = 5;
    /**
     * Test that we can retrieve a list of 5 entries from a file
     *
     * @return void
     * @covers \DragonBe\AzureRedisCaching\Adapter\RepositoryFileAdapter::__construct
     * @covers \DragonBe\AzureRedisCaching\Adapter\RepositoryFileAdapter::getCollection
     * @covers \DragonBe\AzureRedisCaching\Adapter\RepositoryFileAdapter::retrieveData
     */
    public function testCustomerListCanBeProvided(): void
    {
        $adapter = new RepositoryFileAdapter(self::TEST_SOURCE);
        $result = $adapter->getCollection('');
        $this->assertInstanceOf(Traversable::class, $result);
        $this->assertCount(self::TEST_ENTRY_COUNT, $result);
    }

    /**
     * Test that we can retrieve any entity from the backend resource
     *
     * @return void
     * @covers \DragonBe\AzureRedisCaching\Adapter\RepositoryFileAdapter::__construct
     * @covers \DragonBe\AzureRedisCaching\Adapter\RepositoryFileAdapter::getEntity
     * @covers \DragonBe\AzureRedisCaching\Adapter\RepositoryFileAdapter::retrieveData
     */
    public function testCustomerEntryCanBeRetrieved(): void
    {
        $adapter = new RepositoryFileAdapter(self::TEST_SOURCE);
        $result = $adapter->getEntity('entry3');
        $this->assertIsArray($result);
        $this->assertArrayHasKey('name', $result);
        $this->assertSame('entry3', $result['name']);
    }

    /**
     * Test that an entity not found exception was thrown
     * when the referenced identity was not found.
     *
     * @return void
     * @covers \DragonBe\AzureRedisCaching\Adapter\RepositoryFileAdapter::__construct
     * @covers \DragonBe\AzureRedisCaching\Adapter\RepositoryFileAdapter::getEntity
     * @covers \DragonBe\AzureRedisCaching\Adapter\RepositoryFileAdapter::retrieveData
     */
    public function testCustomerEntryIsNotFound(): void
    {
        $adapter = new RepositoryFileAdapter(self::TEST_SOURCE);
        $this->expectException(EntityNotFoundException::class);
        $adapter->getEntity('entry6');
        $this->fail('Expected exception was not thrown');
    }

    /**
     * Test that we also receive an exception when the wrong data source
     * is being queried.
     *
     * @return void
     * @covers \DragonBe\AzureRedisCaching\Adapter\RepositoryFileAdapter::__construct
     * @covers \DragonBe\AzureRedisCaching\Adapter\RepositoryFileAdapter::getEntity
     * @covers \DragonBe\AzureRedisCaching\Adapter\RepositoryFileAdapter::retrieveData
     */
    public function testWrongDataSource(): void
    {
        $adapter = new RepositoryFileAdapter(self::TEST_WRONG_SOURCE);
        $this->expectException(InvalidArgumentException::class);
        $adapter->getEntity('entry1');
        $this->fail('Expected exception was not thrown');
    }
}
