<?php

namespace ShopCore\DomainQueries\Product;

use ShopCore\PersistanceLayer\Models\Product;
use ShopCore\PersistanceLayer\QueryBuilders\ProductQueryBuilder;

class ProductHandler
{
    /**
     * @var ProductQueryBuilder
     */
    private $productQueryBuilder;

    /**
     * ProductHandler constructor.
     * @param ProductQueryBuilder $productQueryBuilder
     */
    public function __construct(ProductQueryBuilder $productQueryBuilder)
    {
        $this->productQueryBuilder = $productQueryBuilder;
    }

    public function getProducts(ProductFilter $filter): array
    {
        return array_map(function (Product $product) {
            return $product->toValueObject()->toArray();
        }, $this->getQuery($filter)->getQuery()->get()->all());
    }

    private function getQuery(ProductFilter $filter): ProductQueryBuilder
    {
        $query = $this->productQueryBuilder->newQuery();

        if ($filter->getCategoryIds()) {
            $query->filterByCategoryIds($filter->getCategoryIds());
        }

        return $query;
    }
}
