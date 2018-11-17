<?php

namespace ShopCore\DomainCommands\Product\CreateProduct;

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
     * @param CreateProductCommand $command
     */
    public function handle(CreateProductCommand $command): void
    {
        $this->productRepository->create(
            $command->getName(),
            $command->getDescription(),
            $command->getPrice(),
            $command->getQuantity(),
            $command->getCategoryId(),
            intval($command->isActive())
        );
    }
}
