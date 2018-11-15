<?php

namespace Shop\Core\PersistanceLayer\ValueObjects;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Shop\Core\PersistanceLayer\Models\Product as ProductModel;

class Product implements Arrayable
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
     * @var string
     */
    private $description;

    /**
     * @var float|null
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
     * @var bool
     */
    private $isActive;

    /**
     * @var Carbon|null
     */
    private $createdAt;

    /**
     * @var Carbon|null
     */
    private $updatedAt;

    /**
     * @var Carbon|null
     */
    private $deletedAt;

    /**
     * Product constructor.
     * @param int $id
     * @param string $name
     * @param string $description
     * @param float|null $price
     * @param int $quantity
     * @param int|null $categoryId
     * @param bool $isActive
     * @param Carbon|null $createdAt
     * @param Carbon|null $updatedAt
     * @param Carbon|null $deletedAt
     */
    public function __construct(int $id, string $name, string $description, ?float $price, int $quantity, ?int $categoryId, bool $isActive, ?Carbon $createdAt, ?Carbon $updatedAt, ?Carbon $deletedAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->categoryId = $categoryId;
        $this->isActive = $isActive;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->deletedAt = $deletedAt;
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
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
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
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @return Carbon|null
     */
    public function getCreatedAt(): ?Carbon
    {
        return $this->createdAt;
    }

    /**
     * @return Carbon|null
     */
    public function getUpdatedAt(): ?Carbon
    {
        return $this->updatedAt;
    }

    /**
     * @return Carbon|null
     */
    public function getDeletedAt(): ?Carbon
    {
        return $this->deletedAt;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            ProductModel::ID => $this->getId(),
            ProductModel::NAME => $this->getName(),
            ProductModel::DESCRIPTION => $this->getDescription(),
            ProductModel::PRICE => $this->getPrice(),
            ProductModel::QUANTITY => $this->getQuantity(),
        ];
    }
}
