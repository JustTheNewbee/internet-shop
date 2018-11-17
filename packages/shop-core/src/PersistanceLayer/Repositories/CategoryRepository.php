<?php

namespace ShopCore\PersistanceLayer\Repositories;

use ShopCore\PersistanceLayer\Models\Category;

class CategoryRepository
{
    /**
     * @param string $name
     * @param null|string $description
     * @param string $key
     * @param int|null $isActive
     */
    public function create(string $name, ?string $description, string $key, ?int $isActive): void
    {
        Category::query()->create(
            [
                Category::NAME => $name,
                Category::DESCRIPTION => $description,
                Category::KEY => $key,
                Category::IS_ACTIVE => $isActive
            ]
        );
    }

    /**
     * @param int $categoryId
     * @param string $name
     * @param null|string $description
     * @param string $key
     * @param int|null $isActive
     */
    public function update(int $categoryId, string $name, ?string $description, string $key, ?int $isActive): void
    {
        $category = Category::query()->find($categoryId);

        $category->update(
            [
                Category::NAME => $name,
                Category::DESCRIPTION => $description,
                Category::KEY => $key,
                Category::IS_ACTIVE => $isActive
            ]
        );
    }

    /**
     * @param int $categoryId
     */
    public function delete(int $categoryId): void
    {
        Category::query()->find($categoryId)->delete();
    }
}
