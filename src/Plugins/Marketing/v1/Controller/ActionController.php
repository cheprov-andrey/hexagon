<?php

namespace App\Plugins\Marketing\v1\Controller;

use App\AppAdapter\AppRequest;
use App\AppAdapter\AppValidator;
use App\Plugins\Common\Controller\BaseController;
use App\Plugins\Marketing\v1\Constraint\ActionConstraint;
use App\Plugins\Marketing\v1\Constraint\ActionRulesConstraint;
use App\Plugins\Marketing\v1\MarketingModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ActionController extends BaseController
{
    private MarketingModel $model;

    public function __construct(MarketingModel $model)
    {
        $this->model = $model;
    }

    /**
     * @Route ("/v1/action/", name="createAction", methods={"POST"})
     * @param AppRequest $appRequest
     * @param AppValidator $validator
     * @return JsonResponse
     */
    public function create(AppRequest $appRequest, AppValidator $validator) : JsonResponse
    {
        if (!$validator->validate($appRequest, ActionConstraint::CREATE_CONSTRAINT)) {
            return new JsonResponse('error', Response::HTTP_BAD_REQUEST);
        }

        if (!$validator->validateForArray(
            [
            'rule' => $appRequest->get('rules')
            ],
            ActionRulesConstraint::CREATE_CONSTRAINT
        )) {
            return new JsonResponse('error', Response::HTTP_BAD_REQUEST);
        }

        $this->model->create($appRequest);
        return new JsonResponse('ok', 200);
    }
}
