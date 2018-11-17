<?php

namespace ShopCore\Tests\Integration\DomainCommands\Order\MakeOrder;

use Carbon\Carbon;
use ShopCore\DomainCommands\Order\MakeOrder\MakeOrderCommand;
use ShopCore\PersistanceLayer\Models\Product;
use ShopCore\Tests\BaseIntegrationTest;

class MakeOrderCommandTest extends BaseIntegrationTest
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
    public function makeOrderTest()
    {
        event(new MakeOrderCommand(
            Product::query()->find(1)->toValueObject(),
            1
        ));

        $expected = [
            [
                'id' => 1,
                'name' => 'Product',
                'description' => 'Product description',
                'price' => 1.0,
                'quantity' => 0,
                'category_id' => 1,
                'is_active' => 1,
            ],
        ];

        self::assertEquals($expected, Product::query()->get(['id', 'name', 'description', 'price', 'quantity', 'category_id', 'is_active'])->toArray());
    }

    /**
     * @test
     */
    public function writeOrderToLogTest()
    {
        $logFile = 'laravel-' . Carbon::now()->toDateString() . '.log';
        file_put_contents(storage_path('logs/'. $logFile), '');

        event(new MakeOrderCommand(
            Product::query()->find(1)->toValueObject(),
            1
        ));

        $this->assertNotEmpty(file_get_contents(storage_path('/logs/'.$logFile)));
    }
}
