<?php

namespace ShopCore\PersistanceLayer\ValueObjects;

use Carbon\Carbon;

class Category
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
     * @var string
     */
    private $key;

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
     * Category constructor.
     * @param int $id
     * @param string $name
     * @param string $description
     * @param string $key
     * @param bool $isActive
     * @param Carbon|null $createdAt
     * @param Carbon|null $updatedAt
     * @param Carbon|null $deletedAt
     */
    public function __construct(int $id, string $name, string $description, string $key, bool $isActive, ?Carbon $createdAt, ?Carbon $updatedAt, ?Carbon $deletedAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->key = $key;
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
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
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
}
