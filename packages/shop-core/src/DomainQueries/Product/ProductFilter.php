<?php

namespace ShopCore\DomainQueries\Product;

class ProductFilter
{
    /**
     * @var array|null
     */
    private $productIds;

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

    /**
     * @return array|null
     */
    public function getProductIds(): ?array
    {
        return $this->productIds;
    }

    /**
     * @param array|null $productIds
     */
    public function setProductIds(array $productIds): void
    {
        $this->productIds = $productIds;
    }
}
