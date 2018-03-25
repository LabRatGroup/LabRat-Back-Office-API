<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
     * List all user related projects.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $this->authorize('list', Project::class);
            $user = auth()->user();
            $userTeams = array_column(auth()->user()->teams->toArray(), 'id');
            $projects = $this->projectRepository->findAllByUserOrTeamMember($user->id, $userTeams);

            return $this->responseOk($projects);
        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
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
     * Creates a new project.
     *
     * @param ProjectRequest $request
     *
     * @return JsonResponse
     */
    public function create(ProjectRequest $request)
    {
        try {
            $params = $request->only([
                'title',
                'description'
            ]);
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
     * Updates project data.
     *
     * @param                $id
     * @param Request        $request
     *
     * @return JsonResponse
     */
    public function update($id, Request $request)
    {

        try {
            $params = $request->only([
                'title',
                'description'
            ]);
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
     * Soft-deletes project and dependencies.
     *
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
