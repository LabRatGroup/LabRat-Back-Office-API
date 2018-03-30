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
use Illuminate\Http\Request;

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
     * Display model details.
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function show($id)
    {
        try {
            /** @var MlModel $model */
            $model = $this->mlModelRepository->findOneOrFailById($id);
            $this->authorize('view', $model->project);

            return $this->responseOk($model);
        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
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

    /**
     * Updates current model.
     *
     * @param         $id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function update($id, Request $request)
    {
        try {
            $params = $request->only([
                'title',
                'description',
                'project_id'
            ]);
            /** @var MlModel $model */
            $model = $this->mlModelRepository->findOneOrFailById($id);
            $this->authorize('update', $model->project);
            if ($params['project_id']) {
                /** @var Project $project */
                $project = $this->projectRepository->findOneOrFailById($params['project_id']);
                $model->setProject($project);
            }

            $model = $this->mlModelRepository->update($model, $params);

            return $this->responseUpdated($model);
        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }

    /**
     * Deletes model.
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function delete($id)
    {
        try {
            /** @var MlModel $model */
            $model = $this->mlModelRepository->findOneOrFailById($id);
            $this->authorize('delete', $model->project);
            $this->mlModelRepository->delete($model);

            return $this->responseDeleted();
        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }
}
