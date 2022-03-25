<?php

namespace App\Plugins\Product\v1\Serializer;

use App\Plugins\Product\Entity\Product;

class ProductSerializer
{
    public function getProductSerializer(Product $product) : array
    {
        return [
            'name' => $product->getName(),
            'weight' => $product->getWeight(),
            'price' => $product->getPrice(),
            'authors' => $product->getAuthors()
        ];
    }
}
