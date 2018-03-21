<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\TeamMemberRemoveRequest;
use App\Http\Requests\TeamMemberRequest;
use App\Models\Team;
use App\Repositories\RoleRepository;
use App\Repositories\TeamRepository;
use App\Repositories\UserRepository;
use \Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

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

    /**
     * Adds a user as a team member.
     *
     * @param TeamMemberRequest $request
     *
     * @return JsonResponse
     */
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

    /**
     * Updates a member-team relation.
     *
     * @param TeamMemberRequest $request
     *
     * @return JsonResponse
     */
    public function updateMember(TeamMemberRequest $request)
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

            if ($team->isOwner($user) == $params['is_owner']) {
                return $this->responseInternalError('User ownership already set.');
            }

            if (auth()->user()->id == $params['user_id']) {
                return $this->responseInternalError('Can not change ownership on itself.');
            }

            $team->users()->updateExistingPivot($user, ['is_owner' => $params['is_owner']]);

            return $this->responseUpdated($team);

        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }

    public function deleteMember(TeamMemberRemoveRequest $request)
    {
        try {
            $params = $request->only([
                'user_id',
                'team_id',
            ]);
            $team = $this->teamRepository->findOneOrFailById($params['team_id']);
            $this->authorize('deleteMember', [
                $team,
                $params['user_id']
            ]);

            $user = $this->userRepository->findOneOrFailById($params['user_id']);

            $team->users()->detach($user);

            return $this->responseUpdated($team);

        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }
}
