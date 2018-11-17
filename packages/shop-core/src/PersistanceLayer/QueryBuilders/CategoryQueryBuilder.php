<?php

namespace ShopCore\PersistanceLayer\QueryBuilders;

use ShopCore\PersistanceLayer\Models\Category;

class CategoryQueryBuilder extends AbstractQueryBuilder
{
    const MODEL = Category::class;

    public function filterById(int $id): void
    {
        $this->getQuery()->where(Category::TABLE . '.' . Category::ID, $id);
    }
}
