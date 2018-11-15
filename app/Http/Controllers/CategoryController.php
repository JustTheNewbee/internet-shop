<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Shop\Core\DomainQueries\Category\CategoryHandler;

class CategoryController extends Controller
{
    /**
     * @var CategoryHandler
     */
    private $categoryHandler;

    /**
     * CategoryController constructor.
     * @param CategoryHandler $categoryHandler
     */
    public function __construct(CategoryHandler $categoryHandler)
    {
        $this->categoryHandler = $categoryHandler;
    }

    /**
     * @return JsonResponse
     * @throws \Exception
     */
    public function index(): JsonResponse
    {
        return response()->json($this->categoryHandler->getCategories());
    }
}
