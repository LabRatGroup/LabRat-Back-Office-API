<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\TeamRequest;
use App\Repositories\TeamRepository;
use \Exception;
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
            $team = $this->teamRepository->create($params);

            return $this->responseCreated($team);

        } catch (Exception $e) {

            return $this->responseInternalError($e->getMessage());
        }
    }
}
