<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\TeamRequest;
use App\Models\Team;
use App\Repositories\TeamRepository;
use \Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

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

    public function update(TeamRequest $request)
    {

        try {
            $params = $request->only('id', 'name');
            $team = $this->teamRepository->findOneOrFailById($params['id']);
            $this->authorize('update', $team);
            $team = $this->teamRepository->update($team, $params);

            return $this->responseUpdated($team);
        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }
}
