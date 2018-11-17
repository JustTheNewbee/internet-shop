<?php

namespace ShopCore\DomainQueries\Category;

use ShopCore\PersistanceLayer\Models\Category;
use ShopCore\PersistanceLayer\QueryBuilders\CategoryQueryBuilder;

class CategoryHandler
{
    /**
     * @var CategoryQueryBuilder
     */
    private $categoryQueryBuilder;

    /**
     * CategoryHandler constructor.
     * @param CategoryQueryBuilder $categoryQueryBuilder
     */
    public function __construct(CategoryQueryBuilder $categoryQueryBuilder)
    {
        $this->categoryQueryBuilder = $categoryQueryBuilder;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getCategories(): array
    {
        $query = $this->categoryQueryBuilder->newQuery();

        return array_map(function (Category $category) {
            return new CategoryResult($category->toValueObject());
        }, $query->getQuery()->get()->all());
    }
}
