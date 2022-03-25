<?php

namespace App\Tests\Plugins\Product\Service;

use App\Plugins\Product\Entity\Product;
use App\Plugins\Product\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductServiceTestCaseTest extends KernelTestCase
{
    /**
     * @dataProvider productProvider
     */
    public function testCreateProduct($product)
    {
        $container = static::getContainer();
        $productService = $container->get(ProductService::class);
        $product = $productService->createProduct($product);
        $this->assertInstanceOf(Product::class, $product);
    }

    public function productProvider()
    {
        return [
            [['name' => 'test-product1', 'weight' => 'test-weight1', 'price' => 1, 'authors' => 1]],
            [['name' => 'test-product2', 'weight' => 'test-weight2', 'price' => 2, 'authors' => 2]],
            [['name' => 'test-product3', 'weight' => 'test-weight3', 'price' => 3, 'authors' => 3]],
            [['name' => 'test-product4', 'weight' => 'test-weight4', 'price' => 4, 'authors' => 4]],
        ];
    }
}
