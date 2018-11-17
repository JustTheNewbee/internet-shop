<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use ShopCore\DomainCommands\Product\CreateProduct\CreateProductCommand;
use ShopCore\DomainCommands\Product\DeleteProduct\DeleteProductCommand;
use ShopCore\DomainCommands\Product\UpdateProduct\UpdateProductCommand;
use ShopCore\DomainQueries\Product\ProductFilter;
use ShopCore\DomainQueries\Product\ProductHandler;
use ShopCore\DomainQueries\ProductInfo\ProductInfoHandler;

class ProductController extends Controller
{
    /**
     * @var ProductInfoHandler
     */
    private $productInfoHandler;

    /**
     * @var ProductHandler
     */
    private $productHandler;

    /**
     * ProductController constructor.
     * @param ProductInfoHandler $productInfoHandler
     * @param ProductHandler $productHandler
     */
    public function __construct(
        ProductInfoHandler $productInfoHandler,
        ProductHandler $productHandler
    ) {
        $this->productInfoHandler = $productInfoHandler;
        $this->productHandler = $productHandler;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function index(Request $request): JsonResponse
    {
        return response()->json($this->productHandler->getProducts($this->getProductDomainFilter($request)));
    }

    private function getProductDomainFilter(Request $request): ProductFilter
    {
        $filter = new ProductFilter();

        if ($request->has('category_id')) {
            $filter->setCategoryIds([$request->get('category_id')]);
        }

        return $filter;
    }

    /**
     * @param ProductRequest $request
     */
    public function store(ProductRequest $request)
    {
        event(new CreateProductCommand(
            $request->get(ProductRequest::NAME),
            $request->get(ProductRequest::DESCRIPTION),
            floatval($request->get(ProductRequest::PRICE)),
            $request->get(ProductRequest::QUANTITY),
            $request->get(ProductRequest::CATEGORY_ID),
            $request->get(ProductRequest::IS_ACTIVE) ? true : false
        ));
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function show(int $id): JsonResponse
    {
        return response()->json($this->productInfoHandler->getCategoryById($id));
    }

    /**
     * @param ProductRequest $request
     * @param int $id
     */
    public function update(ProductRequest $request, int $id)
    {
        event(new UpdateProductCommand(
            $id,
            $request->get(ProductRequest::NAME),
            $request->get(ProductRequest::DESCRIPTION),
            floatval($request->get(ProductRequest::PRICE)),
            $request->get(ProductRequest::QUANTITY),
            $request->get(ProductRequest::CATEGORY_ID),
            $request->get(ProductRequest::IS_ACTIVE) ? true : false
        ));
    }

    /**
     * @param int $id
     */
    public function destroy(int $id)
    {
        event(new DeleteProductCommand($id));
    }
}
