<?php

namespace ShopCore\DomainCommands\Product\UpdateProduct;

use ShopCore\PersistanceLayer\Repositories\ProductRepository;

class Handler
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * Handler constructor.
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param UpdateProductCommand $command
     */
    public function handle(UpdateProductCommand $command): void
    {
        $this->productRepository->update(
            $command->getId(),
            $command->getName(),
            $command->getDescription(),
            $command->getPrice(),
            $command->getQuantity(),
            $command->getCategoryId(),
            $command->isActive()
        );
    }
}
