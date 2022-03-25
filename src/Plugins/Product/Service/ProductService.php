<?php

namespace App\Plugins\Product\Service;

use App\AppAdapter\AppRequest;
use App\Plugins\Common\Service\BaseService;
use App\Plugins\Product\Entity\Product;
use App\Plugins\Product\Repository\ProductRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class ProductService extends BaseService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository, EntityManagerInterface $em)
    {
        parent::__construct($em);
        $this->productRepository = $productRepository;
    }

    public function createProduct(array $attributes) : ?Product
    {
        $product = new Product();
        $product->setName($attributes['name']);
        $product->setWeight($attributes['weight']);
        $product->setPrice($attributes['price']);
        $product->setAuthors($attributes['authors']);
        $this->em->persist($product);
        $this->em->flush($product);
        return $product;
    }

    public function findByArrayId(array $productIds) : ?array
    {
        if (is_array($productIds)) {
            $products = [];
            foreach ($productIds as $productId) {
                $product = $this->productRepository->getById($productId);
                if (!is_null($product)) {
                    $products[] = $product;
                }
            }

            return $products;
        }

        return null;
    }

    public function findById(int $id) : ?Product
    {
        return $this->productRepository->getById($id);
    }
}
