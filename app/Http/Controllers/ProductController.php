<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\JsonResponse;
use ShopCore\DomainCommands\Product\CreateProduct\CreateProductCommand;
use ShopCore\DomainCommands\Product\DeleteProduct\DeleteProductCommand;
use ShopCore\DomainCommands\Product\UpdateProduct\UpdateProductCommand;
use ShopCore\DomainQueries\ProductInfo\ProductInfoHandler;

class ProductController extends Controller
{
    /**
     * @var ProductInfoHandler
     */
    private $productInfoHandler;

    /**
     * ProductController constructor.
     * @param ProductInfoHandler $productInfoHandler
     */
    public function __construct(ProductInfoHandler $productInfoHandler)
    {
        $this->productInfoHandler = $productInfoHandler;
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
