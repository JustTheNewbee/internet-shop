<?php

namespace ShopCore\DomainCommands\Category\DeleteCategory;

class DeleteCategoryCommand
{
    /**
     * @var int
     */
    private $id;

    /**
     * DeleteCategoryCommand constructor.
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
