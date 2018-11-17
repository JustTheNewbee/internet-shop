<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use ShopCore\DomainCommands\Order\MakeOrder\MakeOrderCommand;
use ShopCore\DomainQueries\Product\ProductFilter;
use ShopCore\DomainQueries\Product\ProductHandler;
use ShopCore\PersistanceLayer\ValueObjects\Product;

class OrderController extends Controller
{
    /**
     * @var ProductHandler
     */
    private $productHandler;

    /**
     * OrderController constructor.
     * @param ProductHandler $productHandler
     */
    public function __construct(ProductHandler $productHandler)
    {
        $this->productHandler = $productHandler;
    }

    /**
     * @param OrderRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function makeOrder(OrderRequest $request): JsonResponse
    {
        $products = $this->productHandler->getOrderedProducts($this->getProductDomainFilter($request));

        /** @var Product $product */
        foreach ($products as $product) {
            $errors = $this->validateProduct($product);

            if (!empty($errors)) {
                return response()->json(['errors' =>$errors], 403);
            }

            event(new MakeOrderCommand($product, $request->get(OrderRequest::QUANTITY)));
        }
        return response()->json($products);
    }

    private function getProductDomainFilter(Request $request): ProductFilter
    {
        $filter = new ProductFilter();

        if ($request->has(OrderRequest::PRODUCT_ID)) {
            $filter->setProductIds([$request->get(OrderRequest::PRODUCT_ID)]);
        }

        return $filter;
    }

    private function validateProduct(Product $product): array
    {
        $errors = [];
        if ($product->getQuantity() === 0) {
            $errors[] = 'Product is absent';
        } elseif ($product->getQuantity() < request()->get(OrderRequest::QUANTITY)) {
            $errors[] = 'The requested quantity of product is not available';
        }

        if (!$product->getPrice() || ($product->getPrice() === 0)) {
            $errors[] = 'You can not buy product without price';
        }


        if (!$product->isActive()) {
            $errors[] = 'You can not buy inactive product';
        }

        return $errors;
    }
}
