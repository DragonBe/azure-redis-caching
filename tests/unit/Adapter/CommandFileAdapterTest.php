<?php

declare(strict_types=1);

namespace DragonBe\AzureRedisCachingTests\Adapter;

use DragonBe\AzureRedisCaching\Adapter\CommandFileAdapter;
use PHPUnit\Framework\TestCase;

class CommandFileAdapterTest extends TestCase
{
    private const TEST_WRITE_SOURCE = __DIR__ . '/../_files/write-entity.json';
    private const TEST_UPDATE_SOURCE = __DIR__ . '/../_files/update-entity.json';

    protected function setUp(): void
    {
        parent::setUp();
        file_put_contents(self::TEST_WRITE_SOURCE, json_encode([]));
        $data = json_encode([['name' => 'foo'],['name' => 'bar'], ['name' => 'baz']]);
        file_put_contents(self::TEST_UPDATE_SOURCE, $data);
    }

    /**
     * @return void
     * @covers \DragonBe\AzureRedisCaching\Adapter\CommandFileAdapter::__construct
     * @covers \DragonBe\AzureRedisCaching\Adapter\CommandFileAdapter::create
     * @covers \DragonBe\AzureRedisCaching\Adapter\CommandFileAdapter::writeToFile
     * @covers \DragonBe\AzureRedisCaching\Adapter\CommandFileAdapter::appendToFile
     */
    public function testCanPersistEntityData(): void
    {
        $data = [
            'name' => 'foobar',
        ];
        $adapter = new CommandFileAdapter(self::TEST_WRITE_SOURCE);
        $result = $adapter->create($data);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('name', $result[0]);
        $this->assertSame($data['name'], $result[0]['name']);
    }

    /**
     * @return void
     * @covers \DragonBe\AzureRedisCaching\Adapter\CommandFileAdapter::__construct
     * @covers \DragonBe\AzureRedisCaching\Adapter\CommandFileAdapter::update
     * @covers \DragonBe\AzureRedisCaching\Adapter\CommandFileAdapter::writeToFile
     * @covers \DragonBe\AzureRedisCaching\Adapter\CommandFileAdapter::updateFile
     */
    public function testCanPersistUpdatedEntityData(): void
    {
        $data = [
            'name' => 'foobarbaz',
        ];
        $adapter = new CommandFileAdapter(self::TEST_UPDATE_SOURCE);
        $result = $adapter->update('name', 'bar', $data);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('name', $result[1]);
        $this->assertSame($data['name'], $result[1]['name']);
    }
}
