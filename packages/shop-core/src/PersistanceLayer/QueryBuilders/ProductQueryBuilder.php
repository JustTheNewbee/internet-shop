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
     * @param int $id
     * @throws \Exception
     */
    public function filterById(int $id): void
    {
        $this->getQuery()->where(Product::TABLE . '.' . Product::ID, $id);
    }
}
