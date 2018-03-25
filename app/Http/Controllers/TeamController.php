<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\TeamRequest;
use App\Models\Team;
use App\Repositories\TeamRepository;
use \Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class TeamController extends ApiController
{
    /** @var TeamRepository */
    private $teamRepository;

    /**
     * TeamController constructor.
     *
     * @param TeamRepository $teamRepository
     */
    public function __construct(TeamRepository $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    /**
     * List all available teams associated to a user.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $this->authorize('list', Team::class);
            $userId = auth()->user()->id;
            $teams = $this->teamRepository->findAllByUserMember($userId);

            return $this->responseOk($teams);
        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }

    /**
     * Shows single team item.
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function show($id)
    {
        try {
            $team = $this->teamRepository->findOneOrFailById($id);
            $this->authorize('view', $team);

            return $this->responseOk($team);
        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }

    /**
     * Creates a new team.
     *
     * @param TeamRequest $request
     *
     * @return JsonResponse
     */
    public function create(TeamRequest $request)
    {
        try {
            $params = $request->only('name');
            $this->authorize('create', Team::class);
            $team = $this->teamRepository->create($params);

            return $this->responseCreated($team);
        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }

    /**
     * Updates team info.
     *
     * @param             $id
     * @param TeamRequest $request
     *
     * @return JsonResponse
     */
    public function update($id, TeamRequest $request)
    {
        try {
            $params = $request->only('name');
            $team = $this->teamRepository->findOneOrFailById($id);
            $this->authorize('update', $team);
            $team = $this->teamRepository->update($team, $params);

            return $this->responseUpdated($team);
        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }

    /**
     * Removes team and relations.
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function delete($id)
    {
        try {
            $team = $this->teamRepository->findOneOrFailById($id);
            $this->authorize('delete', $team);
            $team->users()->detach();
            $this->teamRepository->delete($team);

            return $this->responseDeleted();
        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }
}
