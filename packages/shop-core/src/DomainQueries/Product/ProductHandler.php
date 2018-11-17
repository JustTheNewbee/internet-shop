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

    /**
     * @param ProductFilter $filter
     * @return array
     * @throws \Exception
     */
    public function getProducts(ProductFilter $filter): array
    {
        return array_map(function (Product $product) {
            return (new ProductResult($product->toValueObject()))->toArray();
        }, $this->getQuery($filter)->getQuery()->get()->all());
    }

    /**
     * @param ProductFilter $filter
     * @return array
     * @throws \Exception
     */
    public function getOrderedProducts(ProductFilter $filter): array
    {
        return array_map(function (Product $product) {
            return $product->toValueObject();
        }, $this->getQuery($filter)->getQuery()->get()->all());
    }

    private function getQuery(ProductFilter $filter): ProductQueryBuilder
    {
        $query = $this->productQueryBuilder->newQuery();

        if ($filter->getCategoryIds()) {
            $query->filterByCategoryIds($filter->getCategoryIds());
        }
        
        if ($filter->getProductIds()) {
            $query->filterByIds($filter->getProductIds());
        }

        return $query;
    }
}
