<?php

namespace ShopCore\Tests\Integration\DomainCommands\Product\CreateProduct;

use ShopCore\DomainCommands\Product\CreateProduct\CreateProductCommand;
use ShopCore\PersistanceLayer\Models\Product;
use ShopCore\Tests\BaseIntegrationTest;

class CreateProductCommandTest extends BaseIntegrationTest
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
    public function createProductTest()
    {
        event(new CreateProductCommand('Product', 'Product description', 1.0, 1, 1, 1));

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
        ];

        self::assertEquals($expected, Product::query()->get(['id', 'name', 'description', 'price', 'quantity', 'category_id', 'is_active'])->toArray());
    }

    /**
     * @test
     */
    public function createProductDescriptionNull()
    {
        event(new CreateProductCommand('Product', null, 1.0, 1, 1, 1));

        $expected = [
            [
                'id' => 1,
                'name' => 'Product',
                'description' => null,
                'price' => 1.0,
                'quantity' => 1,
                'category_id' => 1,
                'is_active' => 1,
            ],
        ];

        self::assertEquals($expected, Product::query()->get(['id', 'name', 'description', 'price', 'quantity', 'category_id', 'is_active'])->toArray());
    }

    /**
     * @test
     */
    public function createProductCategotyIdNullTest()
    {
        event(new CreateProductCommand('Product', 'Product description', 1.0, 1, null, 1));

        $expected = [
            [
                'id' => 1,
                'name' => 'Product',
                'description' => 'Product description',
                'price' => 1.0,
                'quantity' => 1,
                'category_id' => null,
                'is_active' => 1,
            ],
        ];

        self::assertEquals($expected, Product::query()->get(['id', 'name', 'description', 'price', 'quantity', 'category_id', 'is_active'])->toArray());
    }

    /**
     * @test
     */
    public function createProductIsActiveNullTest()
    {
        event(new CreateProductCommand('Product', 'Product description', 1.0, 1, 1, null));

        $expected = [
            [
                'id' => 1,
                'name' => 'Product',
                'description' => 'Product description',
                'price' => 1.0,
                'quantity' => 1,
                'category_id' => 1,
                'is_active' => 0,
            ],
        ];

        self::assertEquals($expected, Product::query()->get(['id', 'name', 'description', 'price', 'quantity', 'category_id', 'is_active'])->toArray());
    }
}
