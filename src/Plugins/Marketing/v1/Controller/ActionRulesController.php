<?php

namespace App\Plugins\Marketing\v1\Controller;

use App\AppAdapter\AppRequest;
use App\AppAdapter\AppValidator;
use App\Plugins\Common\Controller\BaseController;
use App\Plugins\Marketing\Exception\ActionRulesException;
use App\Plugins\Marketing\v1\Constraint\ActionRulesConstraint;
use App\Plugins\Marketing\v1\MarketingModel;
use App\Plugins\Marketing\v1\Serializer\ActionRulesSerializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActionRulesController extends BaseController
{
    private MarketingModel $model;
    private ActionRulesSerializer $actionRulesSerializer;

    public function __construct(MarketingModel $model, ActionRulesSerializer $actionRulesSerializer)
    {
        $this->model = $model;
        $this->actionRulesSerializer = $actionRulesSerializer;
    }

    /**
     * @Route ("/v1/action-rules/", name="createActionRules", methods={"POST"})
     * @param AppRequest $appRequest
     * @param AppValidator $validator
     * @return array
     * @throws ActionRulesException
     */
    public function create(AppRequest $appRequest, AppValidator $validator) : array
    {
        if (!$validator->validate($appRequest, ActionRulesConstraint::CREATE_CONSTRAINT)) {
            throw new ActionRulesException('error', Response::HTTP_BAD_REQUEST);
        }

        $rules = $this->model->createRules($appRequest);
        return $this->actionRulesSerializer->create($rules);
    }
}
