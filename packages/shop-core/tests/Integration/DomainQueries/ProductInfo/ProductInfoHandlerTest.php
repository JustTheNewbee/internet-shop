<?php

namespace ShopCore\Tests\Integration\DomainQueries\ProductInfo;

use ShopCore\DomainQueries\ProductInfo\ProductInfoHandler;
use ShopCore\Tests\BaseIntegrationTest;

class ProductInfoHandlerTest extends BaseIntegrationTest
{
    /**
     * @var ProductInfoHandler
     */
    private $productInfoHandler;

    protected function setUp()
    {
        parent::setUp();
        $this->productInfoHandler = $this->app->make(ProductInfoHandler::class);
    }

    public function getDataFixtures()
    {
        return [
            'products.json',
            'categories.json',
        ];
    }

    /**
     * @test
     */
    public function getProductInfoTest()
    {
        $expected = [
            'id' => 1,
            'name' => 'Product',
            'description' => 'Product description',
            'price' => 1.0,
            'quantity' => 1,
            'category' => 'Test',
        ];

        self::assertEquals($expected, $this->productInfoHandler->getProductById(1));
    }
}
