<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\MlModelRequest;
use App\Models\MlModel;
use App\Models\Project;
use App\Repositories\MlModelRepository;
use App\Repositories\ProjectRepository;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class MlModelController extends ApiController
{
    /**
     * @var MlModelRepository
     */
    private $mlModelRepository;

    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    /**
     * MlModelController constructor.
     *
     * @param MlModelRepository $mlModelRepository
     * @param ProjectRepository $projectRepository
     */
    public function __construct(MlModelRepository $mlModelRepository, ProjectRepository $projectRepository)
    {
        $this->mlModelRepository = $mlModelRepository;
        $this->projectRepository = $projectRepository;
    }

    /**
     * Creates a new ml model.
     *
     * @param MlModelRequest $request
     *
     * @return JsonResponse
     */
    public function create(MlModelRequest $request)
    {
        try {
            $params = $request->only([
                'title',
                'description',
                'project_id'
            ]);

            /** @var Project $project */
            $project = $this->projectRepository->findOneOrFailById($params['project_id']);

            $this->authorize('update', $project);

            /** @var MlModel $model */
            $model = $this->mlModelRepository->create($params);

            $model->setProject($project);

            return $this->responseCreated($model);
        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }
}
