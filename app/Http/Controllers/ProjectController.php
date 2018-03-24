<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class ProjectController extends ApiController
{
    /** @var ProjectRepository */
    private $projectRepository;

    /**
     * ProjectController constructor.
     *
     * @param ProjectRepository $projectRepository
     */
    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * Shows single project item.
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function show($id)
    {
        try {
            $project = $this->projectRepository->findOneOrFailById($id);
            $this->authorize('view', $project);

            return $this->responseOk($project);
        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }

    /**
     * @param ProjectRequest $request
     *
     * @return JsonResponse
     */
    public function create(ProjectRequest $request)
    {
        try {
            $params = $request->only('title');
            $this->authorize('create', Project::class);
            $project = $this->projectRepository->create($params);

            return $this->responseCreated($project);
        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }

    /**
     * @param                $id
     * @param ProjectRequest $request
     *
     * @return JsonResponse
     */
    public function update($id, ProjectRequest $request)
    {

        try {
            $params = $request->only('title');
            $project = $this->projectRepository->findOneOrFailById($id);
            $this->authorize('update', $project);
            $project = $this->projectRepository->update($project, $params);

            return $this->responseUpdated($project);
        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }

    /**
     * @param $id
     *
     * @return JsonResponse
     */
    public function delete($id)
    {
        try {
            $project = $this->projectRepository->findOneOrFailById($id);
            $this->authorize('delete', $project);
            $project->users()->detach();
            $this->projectRepository->delete($project);

            return $this->responseDeleted();
        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }
}
