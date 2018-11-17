<?php

namespace ShopCore\DomainCommands\Category\DeleteCategory;

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
     * @param DeleteCategoryCommand $command
     */
    public function handle(DeleteCategoryCommand $command): void
    {
        $this->categoryRepository->delete($command->getId());
    }
}
