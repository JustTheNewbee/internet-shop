<?php

namespace ShopCore\DomainCommands\Category\UpdateCategory;

class UpdateCategoryCommand
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
     * @var string
     */
    private $key;

    /**
     * @var bool|null
     */
    private $isActive;

    /**
     * UpdateCategoryCommand constructor.
     * @param int $id
     * @param string $name
     * @param null|string $description
     * @param string $key
     * @param bool|null $isActive
     */
    public function __construct(int $id, string $name, ?string $description, string $key, ?bool $isActive)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->key = $key;
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
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return bool|null
     */
    public function isActive(): ?bool
    {
        return $this->isActive;
    }
}
