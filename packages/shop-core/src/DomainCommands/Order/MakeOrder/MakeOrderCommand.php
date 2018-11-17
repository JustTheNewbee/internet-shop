<?php

namespace ShopCore\DomainCommands\Order\MakeOrder;

use ShopCore\PersistanceLayer\ValueObjects\Product;

class MakeOrderCommand
{
    /**
     * @var Product
     */
    private $product;

    /**
     * @var int
     */
    private $requestedQuantity;

    /**
     * MakeOrderCommand constructor.
     * @param Product $product
     * @param int $requestedQuantity
     */
    public function __construct(Product $product, int $requestedQuantity)
    {
        $this->product = $product;
        $this->requestedQuantity = $requestedQuantity;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @return int
     */
    public function getRequestedQuantity(): int
    {
        return $this->requestedQuantity;
    }
}
