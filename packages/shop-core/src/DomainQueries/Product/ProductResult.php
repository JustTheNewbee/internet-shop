<?php

namespace ShopCore\DomainQueries\Product;

use Illuminate\Contracts\Support\Arrayable;
use ShopCore\PersistanceLayer\ValueObjects\Product;
use ShopCore\PersistanceLayer\Models\Product as ProductModel;

class ProductResult implements Arrayable
{
    /**
     * @var Product
     */
    private $product;

    /**
     * ProductResult constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            ProductModel::ID => $this->product->getId(),
            ProductModel::NAME => $this->product->getName(),
            ProductModel::DESCRIPTION => $this->product->getDescription(),
            ProductModel::PRICE => $this->product->getPrice(),
            ProductModel::QUANTITY => $this->product->getQuantity(),
            ProductModel::CATEGORY_ID => $this->product->getCategoryId(),
        ];
    }
}
