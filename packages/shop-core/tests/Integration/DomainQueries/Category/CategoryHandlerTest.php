<?php

namespace ShopCore\Tests\Integration\DomainQueries\Category;

use ShopCore\DomainQueries\Category\CategoryHandler;
use ShopCore\Tests\BaseIntegrationTest;

class CategoryHandlerTest extends BaseIntegrationTest
{
    /**
     * @var CategoryHandler
     */
    private $categoryHandler;

    protected function setUp()
    {
        parent::setUp();
        $this->categoryHandler = $this->app->make(CategoryHandler::class);
    }

    public function getDataFixtures()
    {
        return [
            'categories.json',
        ];
    }

    /**
     * @test
     */
    public function getCategoriesTest()
    {
        $expected = [
            [
                'id' => 1,
                'name' => 'Category',
                'description' => 'Category description',
            ],
            [
                'id' => 2,
                'name' => 'Category 2',
                'description' => 'Category description 2',
            ]
        ];

        self::assertEquals($expected, $this->categoryHandler->getCategories());
    }
}
