<?php

namespace ShopCore\Tests\Integration\DomainCommands\Product\DeleteProduct;

use ShopCore\DomainCommands\Product\DeleteProduct\DeleteProductCommand;
use ShopCore\PersistanceLayer\Models\Product;
use ShopCore\Tests\BaseIntegrationTest;

class DeleteProductCommandTest extends BaseIntegrationTest
{
    protected function setUp()
    {
        unset(static::$dbInited[static::class]);

        parent::setUp();
    }

    public function getDataFixtures(): array
    {
        return [
            'products.json',
        ];
    }

    /**
     * @test
     */
    public function deleteProductTest()
    {
        event(new DeleteProductCommand(1));

        $expected = [
            [
                'id' => 2,
                'name' => 'Product 2',
                'description' => null,
                'price' => 1.0,
                'quantity' => 1,
                'category_id' => null,
                'is_active' => 1,
            ]
        ];

        self::assertEquals($expected, Product::query()->get(['id', 'name', 'description', 'price', 'quantity', 'category_id', 'is_active'])->toArray());
    }

    /**
     * @test
     */
    public function deleteNotExistProductTest()
    {
        self::expectException(\Error::class);

        event(new DeleteProductCommand(0));
    }
}
