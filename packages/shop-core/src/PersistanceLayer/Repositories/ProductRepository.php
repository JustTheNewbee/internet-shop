<?php

namespace ShopCore\PersistanceLayer\Repositories;

use ShopCore\PersistanceLayer\Models\Product;

class ProductRepository
{
    /**
     * @param string $name
     * @param null|string $description
     * @param float|null $price
     * @param int|null $quantity
     * @param int|null $categoryId
     * @param int|null $isActive
     */
    public function create(
        string $name,
        ?string $description,
        ?float $price,
        ?int $quantity,
        ?int $categoryId,
        ?int $isActive
    ): void {
        Product::query()->create([
            Product::NAME => $name,
            Product::DESCRIPTION => $description,
            Product::PRICE => $price,
            Product::QUANTITY => $quantity,
            Product::CATEGORY_ID => $categoryId,
            Product::IS_ACTIVE => $isActive
        ]);
    }

    /**
     * @param int $id
     * @param string $name
     * @param null|string $description
     * @param float|null $price
     * @param int|null $quantity
     * @param int|null $categoryId
     * @param int|null $isActive
     */
    public function update(
        int $productId,
        string $name,
        ?string $description,
        ?float $price,
        ?int $quantity,
        ?int $categoryId,
        ?int $isActive): void
    {
        $product = Product::query()->find($productId);

        $product->update([
            Product::NAME => $name,
            Product::DESCRIPTION => $description,
            Product::PRICE => $price,
            Product::QUANTITY => $quantity,
            Product::CATEGORY_ID => $categoryId,
            Product::IS_ACTIVE => $isActive
        ]);
    }

    /**
     * @param int $productId
     * @throws \Exception
     */
    public function delete(int $productId): void
    {
        Product::query()->find($productId)->delete();
    }

    /**
     * @param int $productId
     * @param int $quantity
     */
    public function updateQuantity(int $productId, int $quantity): void
    {
        Product::query()
            ->find($productId)
            ->update([
                Product::QUANTITY => $quantity
            ]);
    }
}
