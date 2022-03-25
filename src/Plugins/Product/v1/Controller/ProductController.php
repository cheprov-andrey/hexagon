<?php

namespace App\Plugins\Product\v1\Controller;

use App\AppAdapter\AppRequest;
use App\AppAdapter\AppValidator;
use App\Plugins\Common\Controller\BaseController;
use App\Plugins\Product\Exception\ProductException;
use App\Plugins\Product\v1\Constraint\ProductConstraint;
use App\Plugins\Product\v1\ProductModel;
use App\Plugins\Product\v1\Serializer\ProductSerializer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends BaseController
{
    private ProductModel $model;
    private ProductSerializer $productSerializer;

    public function __construct(ProductModel $model, ProductSerializer $productSerializer)
    {
        $this->model = $model;
        $this->productSerializer = $productSerializer;
    }

    /**
     * @Route ("/v1/product/", name="create", methods={"POST"})
     * @param AppRequest $appRequest
     * @param AppValidator $validator
     * @return array
     * @throws ProductException
     */
    public function create(AppRequest $appRequest, AppValidator $validator): array
    {
        $test = 0;
        if(!$validator->validate($appRequest, ProductConstraint::CREATE_CONSTRAINT)) {
            throw new ProductException('отсутствует параметр', Response::HTTP_BAD_REQUEST);
        }

        $product = $this->model->create($appRequest);
        return $this->productSerializer->getProductId($product);
    }

    /**
     * @Route ("/v1/get-product/", name="getProduct", methods={"GET"})
     * @param AppRequest $appRequest
     * @param AppValidator $validator
     * @return array
     * @throws ProductException
     */
    public function getProduct(AppRequest $appRequest, AppValidator $validator) : array
    {
        if(!$validator->validate($appRequest, ProductConstraint::GET_CONSTRAINT)) {
            throw new ProductException('отсутствует параметр', Response::HTTP_BAD_REQUEST);
        }

        $product = $this->model->get($appRequest);
        if (is_null($product)) {
            throw new ProductException('заказ не найден', Response::HTTP_BAD_REQUEST);
        }

        return $this->productSerializer->getProductSerializer($product);
    }
}
