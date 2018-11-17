<?php

namespace ShopCore\DomainCommands\Category\UpdateCategory;

use ShopCore\PersistanceLayer\Repositories\CategoryRepository;

class Handler
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * Handler constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param UpdateCategoryCommand $command
     */
    public function handle(UpdateCategoryCommand $command)
    {
        $this->categoryRepository->update(
            $command->getId(),
            $command->getName(),
            $command->getDescription(),
            $command->getKey(),
            $command->isActive()
        );
    }
}
