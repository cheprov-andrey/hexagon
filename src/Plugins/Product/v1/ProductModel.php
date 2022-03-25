<?php

namespace App\Plugins\Product\v1;

use App\AppAdapter\AppRequest;
use App\Plugins\Product\Service\ProductService;


class ProductModel
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function create(AppRequest $appRequest) : void
    {
        $this->productService->createProduct($appRequest);
    }

    public function get(AppRequest $request)
    {
        return $this->productService->findById($request->get('id'));
    }
}
