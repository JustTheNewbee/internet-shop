<?php

namespace ShopCore\DomainCommands\Order\MakeOrder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
     * @param MakeOrderCommand $command
     */
    public function handle(MakeOrderCommand $command): void
    {
        DB::transaction(function () use ($command){
            $this->productRepository->updateQuantity(
                $command->getProduct()->getId(),
                $command->getProduct()->getQuantity() - $command->getRequestedQuantity()
            );

            Log::info(
                "Ordered "
                . $command->getRequestedQuantity() . " units of product name \""
                . $command->getProduct()->getName() ."\". Total cost "
                . ($command->getRequestedQuantity() * $command->getProduct()->getPrice()) ." UAH."
            );
        });
    }
}
