<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;
use Shop\Core\DomainQueries\Product\ProductFilter;
use Shop\Core\DomainQueries\Product\ProductHandler;

class ProductController extends Controller
{
    /**
     * @var ProductHandler
     */
    private $productHandler;

    /**
     * ProductController constructor.
     * @param ProductHandler $productHandler
     */
    public function __construct(ProductHandler $productHandler)
    {
        $this->productHandler = $productHandler;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return response()->json($this->productHandler->getProducts($this->getDomainProductFilter($request)));
    }

    private function getDomainProductFilter(Request $request): ProductFilter
    {
        /** @var ProductFilter $filter */
        $filter = app(ProductFilter::class);
        
        if ($request->has('categoryId')) {
            $filter->setCategoryIds([$request->get('categoryId')]);
        }
        
        return $filter;
    }
}
