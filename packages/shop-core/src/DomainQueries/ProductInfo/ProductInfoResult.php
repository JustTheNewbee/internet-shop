<?php

namespace ShopCore\DomainQueries\ProductInfo;

use Illuminate\Contracts\Support\Arrayable;
use ShopCore\PersistanceLayer\ValueObjects\Product;
use ShopCore\PersistanceLayer\Models\Product as ProductModel;

class ProductInfoResult implements Arrayable
{
    /**
     * @var Product
     */
    private $product;

    /**
     * ProductInfoResult constructor.
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
            'category' => $this->product->getCategory() ? $this->product->getCategory()->getName() : null,
        ];
    }
}
