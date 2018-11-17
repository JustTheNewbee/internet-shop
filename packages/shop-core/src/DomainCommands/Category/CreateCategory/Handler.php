<?php

namespace ShopCore\DomainCommands\Category\CreateCategory;

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
     * @param CreateCategoryCommand $command
     */
    public function handle(CreateCategoryCommand $command): void
    {
        $this->categoryRepository->create(
            $command->getName(),
            $command->getDescription(),
            $command->getKey(),
            intval($command->isActive())
        );
    }
}
