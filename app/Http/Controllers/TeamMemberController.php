<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\TeamMemberRequest;
use App\Models\Team;
use App\Repositories\RoleRepository;
use App\Repositories\TeamRepository;
use App\Repositories\UserRepository;
use \Exception;
use Illuminate\Auth\Access\AuthorizationException;

class TeamMemberController extends ApiController
{

    /** @var TeamRepository */
    private $teamRepository;

    /** @var UserRepository */
    private $userRepository;

    /** @var RoleRepository */
    private $roleRepository;

    /**
     * TeamMemberController constructor.
     *
     * @param TeamRepository $teamRepository
     * @param UserRepository $userRepository
     * @param RoleRepository $roleRepository
     */
    public function __construct(TeamRepository $teamRepository, UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->teamRepository = $teamRepository;
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
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
            $role = $this->roleRepository->findOneRoleOrFailByAlias(Team::TEAM_DEFAULT_ROLE_ALIAS);

            $team->users()->attach($user, [
                'is_owner' => $params['is_owner'],
                'role_id'  => $role->id,
            ]);

            return $this->responseUpdated($team);

        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }

    }
}
