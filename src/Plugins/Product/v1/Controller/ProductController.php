<?php

namespace App\Plugins\Product\v1\Controller;

use App\AppAdapter\AppRequest;
use App\AppAdapter\AppValidator;
use App\Plugins\Common\Controller\BaseController;
use App\Plugins\Product\Exception\ProductException;
use App\Plugins\Product\v1\Constraint\ProductConstraint;
use App\Plugins\Product\v1\ProductModel;
use App\Plugins\Product\v1\Serializer\ProductSerializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends BaseController
{
    private ProductModel $model;

    public function __construct(ProductModel $model)
    {
        $this->model = $model;
    }

    /**
     * @Route ("/v1/product/", name="create", methods={"POST"})
     * @param AppRequest $appRequest
     * @param AppValidator $validator
     * @return JsonResponse
     */
    public function create(AppRequest $appRequest, AppValidator $validator): JsonResponse
    {
        if(!$validator->validate($appRequest, ProductConstraint::CREATE_CONSTRAINT)) {
            return new JsonResponse('error', Response::HTTP_BAD_REQUEST);
        }

        $this->model->create($appRequest);
        return new JsonResponse('ok', 200);
    }

    /**
     * @Route ("/v1/get-product/", name="getProduct", methods={"GET"})
     * @param AppRequest $appRequest
     * @param AppValidator $validator
     * @param ProductSerializer $productSerializer
     * @return array
     * @throws ProductException
     */
    public function getProduct(AppRequest $appRequest, AppValidator $validator, ProductSerializer $productSerializer) : array
    {
        if(!$validator->validate($appRequest, ProductConstraint::GET_CONSTRAINT)) {
            throw new ProductException('отсутствует параметр', Response::HTTP_BAD_REQUEST);
        }

        $product = $this->model->get($appRequest);
        if (is_null($product)) {
            throw new ProductException('заказ не найден', Response::HTTP_BAD_REQUEST);
        }

        return $productSerializer->getProductSerializer($product);
    }
}
