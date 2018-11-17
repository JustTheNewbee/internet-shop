<?php

namespace ShopCore\Tests\Integration\DomainCommands\Category\UpdateCategory;

use ShopCore\DomainCommands\Category\UpdateCategory\UpdateCategoryCommand;
use ShopCore\PersistanceLayer\Models\Category;
use ShopCore\Tests\BaseIntegrationTest;

class UpdateCategoryCommandTest extends BaseIntegrationTest
{
    protected function setUp()
    {
        unset(static::$dbInited[static::class]);

        parent::setUp();
    }

    public function getDataFixtures(): array
    {
        return [
            'categories.json',
        ];
    }

    /**
     * @test
     */
    public function updateCategoryTest()
    {
        event(new UpdateCategoryCommand(1, 'Another test', 'Another description', 'another_key', 0));

        $expected = [
            [
                'id' => 1,
                'name' => 'Another test',
                'description' => 'Another description',
                'key' => 'another_key',
                'is_active' => 0,
            ]
        ];

        self::assertEquals($expected, Category::query()->get(['id', 'name', 'description', 'key', 'is_active'])->toArray());
    }

    /**
     * @test
     */
    public function updateCategoryDescriptionNullTest()
    {
        event(new UpdateCategoryCommand(1, 'Test', null, 'test', 1));

        $expected = [
            [
                'id' => 1,
                'name' => 'Test',
                'description' => null,
                'key' => 'test',
                'is_active' => 1,
            ]
        ];

        self::assertEquals($expected, Category::query()->get(['id', 'name', 'description', 'key', 'is_active'])->toArray());
    }

    /**
     * @test
     */
    public function updateCategoryIsActiveNullTest()
    {
        event(new UpdateCategoryCommand(1, 'Test', 'Test description', 'test', null));

        $expected = [
            [
                'id' => 1,
                'name' => 'Test',
                'description' => 'Test description',
                'key' => 'test',
                'is_active' => 0,
            ]
        ];

        self::assertEquals($expected, Category::query()->get(['id', 'name', 'description', 'key', 'is_active'])->toArray());
    }
}
