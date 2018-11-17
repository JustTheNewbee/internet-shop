<?php

namespace ShopCore\Tests\Integration\DomainCommands\Product\UpdateProduct;

use ShopCore\DomainCommands\Product\UpdateProduct\UpdateProductCommand;
use ShopCore\PersistanceLayer\Models\Product;
use ShopCore\Tests\BaseIntegrationTest;

class UpdateProductCommandTest extends BaseIntegrationTest
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
            'products.json',
        ];
    }

    /**
     * @test
     */
    public function updateProductTest()
    {
        event(new UpdateProductCommand(1, 'Another test', 'Another description', 2.0, 2, 2, 0));

        $expected = [
            [
                'id' => 1,
                'name' => 'Another test',
                'description' => 'Another description',
                'price' => 2.0,
                'quantity' => 2,
                'category_id' => 2,
                'is_active' => 0,
            ],
            [
                'id' => 2,
                'name' => 'Product 2',
                'description' => 'Product description 2',
                'price' => 1.0,
                'quantity' => 1,
                'category_id' => 2,
                'is_active' => 1,
            ]
        ];

        self::assertEquals($expected, Product::query()->get(['id', 'name', 'description', 'price', 'quantity', 'category_id', 'is_active'])->toArray());
    }

    /**
     * @test
     */
    public function updateProductDescriptionNullTest()
    {
        event(new UpdateProductCommand(2, 'Product 2', null, 1.0, 1, 2, 1));

        $expected = [
            [
                'id' => 1,
                'name' => 'Product',
                'description' => 'Product description',
                'price' => 1.0,
                'quantity' => 1,
                'category_id' => 1,
                'is_active' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Product 2',
                'description' => null,
                'price' => 1.0,
                'quantity' => 1,
                'category_id' => 2,
                'is_active' => 1,
            ]
        ];

        self::assertEquals($expected, Product::query()->get(['id', 'name', 'description', 'price', 'quantity', 'category_id', 'is_active'])->toArray());
    }

    /**
     * @test
     */
    public function updateProductIsActiveNullTest()
    {
        event(new UpdateProductCommand(2, 'Product 2', 'Product description 2', 1.0, 1, 2, null));

        $expected = [
            [
                'id' => 1,
                'name' => 'Product',
                'description' => 'Product description',
                'price' => 1.0,
                'quantity' => 1,
                'category_id' => 1,
                'is_active' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Product 2',
                'description' => 'Product description 2',
                'price' => 1.0,
                'quantity' => 1,
                'category_id' => 2,
                'is_active' => 0,
            ]
        ];

        self::assertEquals($expected, Product::query()->get(['id', 'name', 'description', 'price', 'quantity', 'category_id', 'is_active'])->toArray());
    }
}
