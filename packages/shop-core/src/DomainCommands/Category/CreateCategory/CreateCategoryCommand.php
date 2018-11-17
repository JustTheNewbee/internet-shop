<?php

namespace ShopCore\DomainCommands\Category\CreateCategory;

use ShopCore\PersistanceLayer\Repositories\CategoryRepository;

class CreateCategoryCommand
{
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
     * CreateCategoryCommand constructor.
     * @param string $name
     * @param null|string $description
     * @param string $key
     * @param bool|null $isActive
     */
    public function __construct(string $name, ?string $description, string $key, ?bool $isActive)
    {
        $this->name = $name;
        $this->description = $description;
        $this->key = $key;
        $this->isActive = $isActive;
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
