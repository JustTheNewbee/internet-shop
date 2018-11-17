<?php

namespace ShopCore\DomainCommands\Product\DeleteProduct;

class DeleteProductCommand
{
    /**
     * @var int
     */
    private $id;

    /**
     * DeleteProductCommand constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
