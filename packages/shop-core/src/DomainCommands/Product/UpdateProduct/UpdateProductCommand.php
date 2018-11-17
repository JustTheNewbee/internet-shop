<?php

namespace ShopCore\DomainCommands\Product\UpdateProduct;

class UpdateProductCommand
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var float
     */
    private $price;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var int|null
     */
    private $categoryId;

    /**
     * @var bool|null
     */
    private $isActive;

    /**
     * UpdateProductCommand constructor.
     * @param int $id
     * @param string $name
     * @param null|string $description
     * @param float $price
     * @param int $quantity
     * @param int|null $categoryId
     * @param bool|null $isActive
     */
    public function __construct(
        int $id,
        string $name,
        ?string $description,
        float $price,
        int $quantity,
        ?int $categoryId,
        ?bool $isActive
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->categoryId = $categoryId;
        $this->isActive = $isActive;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return int|null
     */
    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    /**
     * @return bool|null
     */
    public function isActive(): ?bool
    {
        return $this->isActive;
    }
}
