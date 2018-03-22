<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;

class ProjectController extends ApiController
{
    /** @var ProjectRepository */
    private $projectRepository;

    /**
     * ProjectController constructor.
     * @param ProjectRepository $projectRepository
     */
    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

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

}
