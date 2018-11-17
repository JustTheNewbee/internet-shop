<?php

namespace ShopCore\DomainQueries\Category;

use Illuminate\Contracts\Support\Arrayable;
use ShopCore\PersistanceLayer\ValueObjects\Category;
use ShopCore\PersistanceLayer\Models\Category as CategoryModel;

class CategoryResult implements Arrayable
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
    public function toArray(): array
    {
        return [
            CategoryModel::ID => $this->category->getId(),
            CategoryModel::NAME => $this->category->getName(),
            CategoryModel::DESCRIPTION => $this->category->getDescription(),
        ];
    }
}
