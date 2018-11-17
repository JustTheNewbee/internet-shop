<?php

namespace ShopCore\DomainQueries\CategoryInfo;

use Illuminate\Contracts\Support\Arrayable;
use ShopCore\PersistanceLayer\ValueObjects\Category;
use ShopCore\PersistanceLayer\Models\Category as CategoryModel;

class CategoryInfoResult implements Arrayable
{
    /**
     * @var Category
     */
    private $category;

    /**
     * CategoryResult constructor.
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            CategoryModel::ID => $this->category->getId(),
            CategoryModel::NAME => $this->category->getName(),
            CategoryModel::DESCRIPTION=> $this->category->getDescription(),
            CategoryModel::KEY=> $this->category->getKey(),
            CategoryModel::IS_ACTIVE=> $this->category->isActive(),
            CategoryModel::CREATED_AT=> $this->category->getCreatedAt() ? $this->category->getCreatedAt()->toDateTimeString() : null,
        ];
    }
}
