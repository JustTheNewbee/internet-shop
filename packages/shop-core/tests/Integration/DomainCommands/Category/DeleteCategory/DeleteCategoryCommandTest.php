<?php

namespace ShopCore\Tests\Integration\DomainCommands\Category\DeleteCategory;

use ShopCore\DomainCommands\Category\DeleteCategory\DeleteCategoryCommand;
use ShopCore\PersistanceLayer\Models\Category;
use ShopCore\Tests\BaseIntegrationTest;

class DeleteCategoryCommandTest extends BaseIntegrationTest
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
    public function deleteCategoryTest()
    {
        event(new DeleteCategoryCommand(1));

        self::assertEquals([], Category::query()->get(['id', 'name', 'description', 'key', 'is_active'])->toArray());
    }

    /**
     * @test
     */
    public function deleteNotExistCategoryTest()
    {
        self::expectException(\Error::class);

        event(new DeleteCategoryCommand(0));
    }
}
