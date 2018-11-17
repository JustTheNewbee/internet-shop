<?php

namespace ShopCore\PersistanceLayer\QueryBuilders;

use ShopCore\PersistanceLayer\Models\Product;

class ProductQueryBuilder extends AbstractQueryBuilder
{
    const MODEL = Product::class;

    /**
     * @param array $categoryIds
     * @throws \Exception
     */
    public function filterByCategoryIds(array $categoryIds): void
    {
        $this->getQuery()->whereIn(Product::TABLE . '.' . Product::CATEGORY_ID, $categoryIds);
    }

    /**
     * @param array $ids
     * @throws \Exception
     */
    public function filterByIds(array $ids): void
    {
        $this->getQuery()->whereIn(Product::TABLE . '.' . Product::ID, $ids);
    }
}
