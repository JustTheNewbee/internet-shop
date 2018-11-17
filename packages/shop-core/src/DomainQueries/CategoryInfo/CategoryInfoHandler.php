<?php

namespace ShopCore\DomainQueries\CategoryInfo;

use ShopCore\PersistanceLayer\QueryBuilders\CategoryQueryBuilder;

class CategoryInfoHandler
{
    /**
     * @var CategoryQueryBuilder
     */
    private $categoryQueryBuilder;

    /**
     * CategoryInfoHandler constructor.
     * @param CategoryQueryBuilder $categoryQueryBuilder
     */
    public function __construct(CategoryQueryBuilder $categoryQueryBuilder)
    {
        $this->categoryQueryBuilder = $categoryQueryBuilder;
    }

    /**
     * @param int $id
     * @return array
     * @throws \Exception
     */
    public function getCategoryById(int $id): array
    {
        $query = $this->categoryQueryBuilder->newQuery();
        $query->filterById($id);

        return (new CategoryInfoResult($query->getQuery()->first()->toValueObject()))->toArray();
    }
}
