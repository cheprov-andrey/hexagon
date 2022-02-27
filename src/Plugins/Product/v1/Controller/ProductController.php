<?php

namespace App\Plugins\Product\v1\Controller;

use App\AppAdapter\AppRequest;
use App\AppAdapter\AppValidator;
use App\Plugins\Common\Controller\BaseController;
use App\Plugins\Product\v1\Constraint\ProductConstraint;
use App\Plugins\Product\v1\ProductModel;
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
     * @Route ("/v1/product/", name="index", methods={"GET"})
     * @param AppRequest $appRequest
     * @param AppValidator $validator
     * @return JsonResponse
     */
    public function create(AppRequest $appRequest, AppValidator $validator): JsonResponse
    {
        if(!$validator->validate($appRequest, ProductConstraint::CREATE_CONSTRAINT)) {
            return new JsonResponse('error', Response::HTTP_BAD_REQUEST);
        }

        $result = $this->model->create($appRequest);
        return new JsonResponse('ok', 200);
    }
}
