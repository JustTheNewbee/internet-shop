<?php

namespace ShopCore\Tests\Integration\DomainCommands\Category\CreateCategory;

use Illuminate\Database\QueryException;
use ShopCore\DomainCommands\Category\CreateCategory\CreateCategoryCommand;
use ShopCore\PersistanceLayer\Models\Category;
use ShopCore\Tests\BaseIntegrationTest;

class CreateCategoryCommandTest extends BaseIntegrationTest
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
    public function createCategoryTest()
    {
        event(new CreateCategoryCommand('Test', 'Test description', 'test',  1));

        $expected = [
            [
                'id' => 1,
                'name' => 'Test',
                'description' => 'Test description',
                'key' => 'test',
                'is_active' => 1,
            ]
        ];

        self::assertEquals($expected, Category::query()->get(['id', 'name', 'description', 'key', 'is_active'])->toArray());
    }

    /**
     * @test
     */
    public function createCategoryNullableDescriptionTest()
    {
        event(new CreateCategoryCommand('Test', null, 'test',  1));

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
    public function createCategoryNullableIsActiveTest()
    {
        event(new CreateCategoryCommand('Test', 'Test description', 'test',  null));

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

    /**
     * @test
     */
    public function createCategoriesWithTheSameKey()
    {
        self::expectException(QueryException::class);

        event(new CreateCategoryCommand('Test', 'Test description', 'test',  1));
        event(new CreateCategoryCommand('Another test', 'Another test description', 'test',  1));
    }
}
