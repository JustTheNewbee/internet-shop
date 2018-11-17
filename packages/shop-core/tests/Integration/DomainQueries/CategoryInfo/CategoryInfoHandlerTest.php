<?php

namespace ShopCore\Tests\Integration\DomainQueries\CategoryInfo;

use ShopCore\DomainQueries\CategoryInfo\CategoryInfoHandler;
use ShopCore\Tests\BaseIntegrationTest;

class CategoryInfoHandlerTest extends BaseIntegrationTest
{
    /**
     * @var CategoryInfoHandler
     */
    private $categoryInfoHandler;

    protected function setUp()
    {
        parent::setUp();
        $this->categoryInfoHandler = $this->app->make(CategoryInfoHandler::class);
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
    public function getCategoryInfoTest()
    {
        $expected = [
            'id' => 1,
            'name' => 'Category',
            'description' => 'Category description',
            'key' => 'category',
            'is_active' => true,
            'created_at' => '2018-11-17 22:44:00',
        ];

        self::assertEquals($expected, $this->categoryInfoHandler->getCategoryById(1));
    }
}
