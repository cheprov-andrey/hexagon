<?php

namespace App\Plugins\Marketing\v1\Controller;

use App\AppAdapter\AppRequest;
use App\AppAdapter\AppValidator;
use App\Plugins\Common\Controller\BaseController;
use App\Plugins\Marketing\Exception\ActionException;
use App\Plugins\Marketing\v1\Constraint\ActionConstraint;
use App\Plugins\Marketing\v1\Constraint\ActionRulesConstraint;
use App\Plugins\Marketing\v1\MarketingModel;
use App\Plugins\Marketing\v1\Serializer\ActionSerializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ActionController extends BaseController
{
    private MarketingModel $model;
    private ActionSerializer $actionSerializer;

    public function __construct(MarketingModel $model, ActionSerializer $actionSerializer)
    {
        $this->model = $model;
        $this->actionSerializer = $actionSerializer;
    }

    /**
     * @Route ("/v1/action/", name="createAction", methods={"POST"})
     * @param AppRequest $appRequest
     * @param AppValidator $validator
     * @return array
     * @throws ActionException
     */
    public function create(AppRequest $appRequest, AppValidator $validator) : array
    {
        if (!$validator->validate($appRequest, ActionConstraint::CREATE_CONSTRAINT)) {
            throw new ActionException('error', Response::HTTP_BAD_REQUEST);
        }

        if (!$validator->validateForArray(
            [
            'rule' => $appRequest->get('rules')
            ],
            ActionRulesConstraint::CREATE_CONSTRAINT
        )) {
            throw new ActionException('error', Response::HTTP_BAD_REQUEST);
        }

        $action = $this->model->create($appRequest);
        return $this->actionSerializer->create($action);
    }
}
