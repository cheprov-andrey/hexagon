<?php

namespace App\Plugins\Marketing\v1\Controller;

use App\AppAdapter\AppRequest;
use App\AppAdapter\AppValidator;
use App\Plugins\Common\Controller\BaseController;
use App\Plugins\Marketing\v1\Constraint\ActionRulesConstraint;
use App\Plugins\Marketing\v1\MarketingModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActionRulesController extends BaseController
{
    private MarketingModel $model;

    public function __construct(MarketingModel $model)
    {
        $this->model = $model;
    }

    /**
     * @Route ("/v1/action-rules/", name="createActionRules", methods={"POST"})
     * @param AppRequest $appRequest
     * @param AppValidator $validator
     * @return JsonResponse
     */
    public function create(AppRequest $appRequest, AppValidator $validator) : JsonResponse
    {
        if (!$validator->validate($appRequest, ActionRulesConstraint::CREATE_CONSTRAINT)) {
            return new JsonResponse('error', Response::HTTP_BAD_REQUEST);
        }

        $this->model->createRules($appRequest);
        return new JsonResponse('ok', 200);
    }
}
