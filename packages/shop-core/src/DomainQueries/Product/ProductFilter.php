<?php

namespace Shop\Core\DomainQueries\Product;

class ProductFilter
{
    /**
     * @var array|null
     */
    private $categoryIds;

    /**
     * @return array|null
     */
    public function getCategoryIds(): ?array
    {
        return $this->categoryIds;
    }

    /**
     * @param array $categoryIds
     */
    public function setCategoryIds(array $categoryIds): void
    {
        $this->categoryIds = $categoryIds;
    }
}
