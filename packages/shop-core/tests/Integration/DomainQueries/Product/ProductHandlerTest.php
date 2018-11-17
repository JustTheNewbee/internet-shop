<?php

namespace ShopCore\Tests\Integration\DomainQueries\Product;

use ShopCore\DomainQueries\Product\ProductFilter;
use ShopCore\DomainQueries\Product\ProductHandler;
use ShopCore\Tests\BaseIntegrationTest;

class ProductHandlerTest extends BaseIntegrationTest
{
    /**
     * @var ProductHandler
     */
    private $productHandler;

    protected function setUp()
    {
        parent::setUp();
        $this->productHandler = $this->app->make(ProductHandler::class);
    }

    public function getDataFixtures()
    {
        return [
            'products.json',
            'categories.json',
        ];
    }

    public function filterProvider()
    {
        return [
            [
                'filters' => [
                    'category_ids' => null,
                    'product_ids' => null,
                ],
                'expectedProducts' => [
                    [
                        'id' => 1,
                        'name' => 'Product',
                        'description' => 'Product description',
                        'price' => 1.0,
                        'quantity' => 1,
                        'category_id' => 1,
                    ],
                    [
                        'id' => 2,
                        'name' => 'Product 2',
                        'description' => 'Product description 2',
                        'price' => 1.0,
                        'quantity' => 1,
                        'category_id' => 2,
                    ]
                ],
            ],
            [
                'filters' => [
                    'category_ids' => [1],
                    'product_ids' => null,
                ],
                'expectedProducts' => [
                    [
                        'id' => 1,
                        'name' => 'Product',
                        'description' => 'Product description',
                        'price' => 1.0,
                        'quantity' => 1,
                        'category_id' => 1,
                    ],
                ],
            ],
            [
                'filters' => [
                    'category_ids' => null,
                    'product_ids' => [2],
                ],
                'expectedProducts' => [
                    [
                        'id' => 2,
                        'name' => 'Product 2',
                        'description' => 'Product description 2',
                        'price' => 1.0,
                        'quantity' => 1,
                        'category_id' => 2,
                    ]
                ],
            ],
            [
                'filters' => [
                    'category_ids' => [1],
                    'product_ids' => [2],
                ],
                'expectedProducts' => [],
            ],
        ];
    }

    /**
     * @param array $filters
     * @param array $expected
     * @throws \Exception
     *
     * @test
     * @dataProvider filterProvider
     */
    public function getProductsTest(array $filters, array $expected)
    {
        $filter = new ProductFilter();

        if ($filters['category_ids']) {
            $filter->setCategoryIds($filters['category_ids']);
        }

        if ($filters['product_ids']) {
            $filter->setProductIds($filters['product_ids']);
        }

        self::assertEquals($expected, $this->productHandler->getProducts($filter));
    }

    public function orderedFilterProvider()
    {
        return [
            [
                'filters' => [
                    'category_ids' => null,
                    'product_ids' => null,
                ],
                'expectedProducts' => [
                    [
                        'getId' => 1,
                        'getName' => 'Product',
                        'getDescription' => 'Product description',
                        'getPrice' => 1.0,
                        'getQuantity' => 1,
                        'getCategoryId' => 1,
                        'getCreatedAt' => '2018-11-17 21:29:09',
                        'getUpdatedAt' => '2018-11-17 21:29:09',
                        'getDeletedAt' => null,
                        'getCategory' => [
                            [
                                'getId' => 1,
                                'getName' => 'Test',
                                'getDescription' => 'Test description',
                                'getKey' => 'test',
                                'getCreatedAt' => '2018-11-17 21:29:09',
                                'getUpdatedAt' => '2018-11-17 21:29:09',
                                'getDeletedAt' => null,
                            ]
                        ],
                    ],
                    [
                        'getId' => 2,
                        'getName' => 'Product 2',
                        'getDescription' => 'Product description 2',
                        'getPrice' => 1.0,
                        'getQuantity' => 1,
                        'getCategoryId' => 2,
                        'getCreatedAt' => '2018-11-17 21:29:09',
                        'getUpdatedAt' => '2018-11-17 21:29:09',
                        'getDeletedAt' => null,
                        'getCategory' => [
                            [
                                'getId' => 2,
                                'getName' => 'Category',
                                'getDescription' => 'Category description',
                                'getKey' => 'category',
                                'getCreatedAt' => '2018-11-17 21:29:09',
                                'getUpdatedAt' => '2018-11-17 21:29:09',
                                'getDeletedAt' => null,
                            ]
                        ],
                    ]
                ],
            ],
            [
                'filters' => [
                    'category_ids' => [1],
                    'product_ids' => null,
                ],
                'expectedProducts' => [
                    [
                        'getId' => 1,
                        'getName' => 'Product',
                        'getDescription' => 'Product description',
                        'getPrice' => 1.0,
                        'getQuantity' => 1,
                        'getCategoryId' => 1,
                        'getCreatedAt' => '2018-11-17 21:29:09',
                        'getUpdatedAt' => '2018-11-17 21:29:09',
                        'getDeletedAt' => null,
                        'getCategory' => [
                            [
                                'getId' => 1,
                                'getName' => 'Test',
                                'getDescription' => 'Test description',
                                'getKey' => 'test',
                                'getCreatedAt' => '2018-11-17 21:29:09',
                                'getUpdatedAt' => '2018-11-17 21:29:09',
                                'getDeletedAt' => null,
                            ]
                        ],
                    ],
                ],
            ],
            [
                'filters' => [
                    'category_ids' => null,
                    'product_ids' => [2],
                ],
                'expectedProducts' => [
                    [
                        'getId' => 2,
                        'getName' => 'Product 2',
                        'getDescription' => 'Product description 2',
                        'getPrice' => 1.0,
                        'getQuantity' => 1,
                        'getCategoryId' => 2,
                        'getCreatedAt' => '2018-11-17 21:29:09',
                        'getUpdatedAt' => '2018-11-17 21:29:09',
                        'getDeletedAt' => null,
                        'getCategory' => [
                            [
                                'getId' => 2,
                                'getName' => 'Category',
                                'getDescription' => 'Category description',
                                'getKey' => 'category',
                                'getCreatedAt' => '2018-11-17 21:29:09',
                                'getUpdatedAt' => '2018-11-17 21:29:09',
                                'getDeletedAt' => null,
                            ]
                        ],
                    ]
                ],
            ],
            [
                'filters' => [
                    'category_ids' => [1],
                    'product_ids' => [2],
                ],
                'expectedProducts' => [],
            ],
        ];
    }
    /**
     * @param array $filters
     * @param array $expected
     * @throws \Exception
     *
     * @test
     * @dataProvider orderedFilterProvider
     */
    public function getOrderedProductsTest(array $filters, array $expected)
    {
        $filter = new ProductFilter();

        if ($filters['category_ids']) {
            $filter->setCategoryIds($filters['category_ids']);
        }

        if ($filters['product_ids']) {
            $filter->setProductIds($filters['product_ids']);
        }

        self::assertEquals($expected, $this->arrayOfObjectsToArray($this->productHandler->getOrderedProducts($filter)));
    }
}
