<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\ProjectTeamRequest;
use App\Repositories\ProjectRepository;
use App\Repositories\TeamRepository;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class ProjectTeamController extends ApiController
{
    /** @var ProjectRepository */
    private $projectRepository;

    /** @var TeamRepository */
    private $teamRepository;

    /**
     * ProjectTeamController constructor.
     *
     * @param ProjectRepository $projectRepository
     * @param TeamRepository    $teamRepository
     */
    public function __construct(ProjectRepository $projectRepository, TeamRepository $teamRepository)
    {
        $this->projectRepository = $projectRepository;
        $this->teamRepository = $teamRepository;
    }

    /**
     * Associates a team to a project.
     *
     * @param ProjectTeamRequest $request
     *
     * @return JsonResponse
     */
    public function addTeam(ProjectTeamRequest $request)
    {
        try {
            $params = $request->only([
                'team_id',
                'project_id',
            ]);
            $project = $this->projectRepository->findOneOrFailById($params['project_id']);
            $this->authorize('update', $project);

            $team = $this->teamRepository->findOneOrFailById($params['team_id']);
            $this->authorize('update', $team);

            $project->teams()->attach($team);

            return $this->responseUpdated($project);

        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }

    /**
     * Removes team from project.
     *
     * @param ProjectTeamRequest $request
     *
     * @return JsonResponse
     */
    public function deleteTeam(ProjectTeamRequest $request)
    {
        try {
            $params = $request->only([
                'team_id',
                'project_id',
            ]);
            $project = $this->projectRepository->findOneOrFailById($params['project_id']);
            $this->authorize('delete', $project);

            $team = $this->teamRepository->findOneOrFailById($params['team_id']);
            $this->authorize('delete', $team);

            $project->teams()->detach($team);

            return $this->responseDeleted($project);

        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }
}
