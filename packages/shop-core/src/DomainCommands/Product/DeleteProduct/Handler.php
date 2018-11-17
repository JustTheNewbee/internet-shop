<?php

namespace ShopCore\DomainCommands\Product\DeleteProduct;

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
     * @param DeleteProductCommand $command
     */
    public function handle(DeleteProductCommand $command): void
    {
        $this->productRepository->delete($command->getId());
    }
}
