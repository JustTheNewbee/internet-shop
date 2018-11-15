<?php

namespace Shop\Core\DomainQueries\Category;

use Shop\Core\PersistanceLayer\Models\Category;
use Shop\Core\PersistanceLayer\QueryBuilders\CategoryQueryBuilder;

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
            return $category->toValueObject()->toArray();
        }, $query->getQuery()->get()->all());
    }
}
