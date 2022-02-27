<?php

namespace App\Plugins\Product\Service;

use App\Plugins\Product\Repository\ProductRepository;

class ProductService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function createProduct()
    {
        $test = 0;
        return $this->productRepository->getProduct([12]);
    }
}
