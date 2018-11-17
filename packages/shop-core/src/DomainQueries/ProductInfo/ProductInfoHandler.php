<?php

namespace ShopCore\DomainQueries\ProductInfo;

use ShopCore\PersistanceLayer\QueryBuilders\ProductQueryBuilder;

class ProductInfoHandler
{
    /**
     * @var ProductQueryBuilder
     */
    private $productQueryBuilder;

    /**
     * ProductInfoHandler constructor.
     * @param ProductQueryBuilder $productQueryBuilder
     */
    public function __construct(ProductQueryBuilder $productQueryBuilder)
    {
        $this->productQueryBuilder = $productQueryBuilder;
    }

    /**
     * @param int $id
     * @return array
     * @throws \Exception
     */
    public function getCategoryById(int $id): array
    {
        $query = $this->productQueryBuilder->newQuery();
        $query->filterById($id);

        return (new ProductInfoResult($query->getQuery()->first()->toValueObject()))->toArray();
    }
}
