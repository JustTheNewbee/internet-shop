<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use Illuminate\Http\JsonResponse;
use ShopCore\DomainCommands\Category\CreateCategory\CreateCategoryCommand;
use ShopCore\DomainCommands\Category\DeleteCategory\DeleteCategoryCommand;
use ShopCore\DomainCommands\Category\UpdateCategory\UpdateCategoryCommand;
use ShopCore\DomainQueries\CategoryInfo\CategoryInfoHandler;

class CategoryController extends Controller
{
    /**
     * @var CategoryInfoHandler
     */
    private $categoryInfoHandler;

    /**
     * CategoryController constructor.
     * @param CategoryInfoHandler $categoryInfoHandler
     */
    public function __construct(CategoryInfoHandler $categoryInfoHandler)
    {
        $this->categoryInfoHandler = $categoryInfoHandler;
    }

    /**
     * @param CategoryRequest $request
     */
    public function store(CategoryRequest $request)
    {
        event(new CreateCategoryCommand(
            $request->get(CategoryRequest::NAME),
            $request->get(CategoryRequest::DESCRIPTION),
            $request->get(CategoryRequest::KEY),
            $request->get(CategoryRequest::IS_ACTIVE) ? true : false
        ));
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function show(int $id): JsonResponse
    {
        return response()->json($this->categoryInfoHandler->getCategoryById($id));
    }

    /**
     * @param CategoryRequest $request
     * @param $id
     */
    public function update(CategoryRequest $request, int $id)
    {
        event(new UpdateCategoryCommand(
            $id,
            $request->get(CategoryRequest::NAME),
            $request->get(CategoryRequest::DESCRIPTION),
            $request->get(CategoryRequest::KEY),
            $request->get(CategoryRequest::IS_ACTIVE) ? true : false
        ));
    }

    /**
     * @param $id
     */
    public function destroy(int $id)
    {
        event(new DeleteCategoryCommand($id));
    }
}
