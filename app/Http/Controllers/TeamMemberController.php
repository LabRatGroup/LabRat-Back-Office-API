<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\TeamMemberRequest;
use App\Repositories\TeamRepository;
use App\Repositories\UserRepository;
use \Exception;
use Illuminate\Http\Request;

class TeamMemberController extends ApiController
{

    /** @var TeamRepository */
    private $teamRepository;

    /** @var UserRepository */
    private $userRepository;

    /**
     * TeamMemberController constructor.
     *
     * @param TeamRepository $teamRepository
     * @param UserRepository $userRepository
     */
    public function __construct(TeamRepository $teamRepository, UserRepository $userRepository)
    {
        $this->teamRepository = $teamRepository;
        $this->userRepository = $userRepository;
    }


    public function addMember(TeamMemberRequest $request)
    {
        try {
            $params = $request->only([
                'user_id',
                'team_id',
                'is_owner'
            ]);
            $team = $this->teamRepository->findOneOrFailById($params['team_id']);
            $this->authorize('update', $team);

            $user = $this->userRepository->findOneOrFailById($params['user_id']);

            $team->users()->attach($user, ['is_owner' => $params['is_owner']]);

            return $this->responseUpdated($team);

        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }

    }
}
