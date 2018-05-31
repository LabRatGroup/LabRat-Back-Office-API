<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ProjectMemberRemoveRequest;
use App\Http\Requests\ProjectMemberRequest;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class ProjectMemberController extends ApiController
{
    /** @var ProjectRepository */
    private $projectRepository;

    /** @var UserRepository */
    private $userRepository;

    /** @var RoleRepository */
    private $roleRepository;

    /**
     * ProjectMemberController constructor.
     *
     * @param ProjectRepository $projectRepository
     * @param UserRepository    $userRepository
     * @param RoleRepository    $roleRepository
     */
    public function __construct(ProjectRepository $projectRepository, UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->projectRepository = $projectRepository;
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Adds a new member to project.
     *
     * @param ProjectMemberRequest $request
     *
     * @return JsonResponse
     */
    public function addMember(ProjectMemberRequest $request)
    {
        try {
            $params = $request->only([
                'user_id',
                'project_id',
                'is_owner'
            ]);
            $project = $this->projectRepository->findOneOrFailById($params['project_id']);
            $this->authorize('update', $project);

            $user = $this->userRepository->findOneOrFailById($params['user_id']);
            $role = $this->roleRepository->findOneRoleOrFailByAlias(Project::PROJECT_DEFAULT_ROLE_ALIAS);

            $project->users()->attach($user, [
                'is_owner' => $params['is_owner'],
                'role_id'  => $role->id,
            ]);

            return $this->responseUpdated($project);

        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }

    /**
     * Updates member properties from project.
     *
     * @param ProjectMemberRequest $request
     *
     * @return JsonResponse
     */
    public function updateMember(ProjectMemberRequest $request)
    {
        try {
            $params = $request->only([
                'user_id',
                'project_id',
                'is_owner'
            ]);
            $project = $this->projectRepository->findOneOrFailById($params['project_id']);
            $this->authorize('update', $project);

            $user = $this->userRepository->findOneOrFailById($params['user_id']);

            if ($project->isOwner($user) == $params['is_owner']) {
                return $this->responseInternalError('User ownership already set.');
            }

            if (auth()->user()->id == $params['user_id']) {
                return $this->responseInternalError('Can not change ownership on itself.');
            }

            $project->users()->updateExistingPivot($user, ['is_owner' => $params['is_owner']]);

            return $this->responseUpdated($project);

        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }

    /**
     * Removes member from project.
     *
     * @param ProjectMemberRemoveRequest $request
     *
     * @return JsonResponse
     */
    public function deleteMember(ProjectMemberRemoveRequest $request)
    {
        try {
            $params = $request->only([
                'user_id',
                'project_id',
            ]);
            $project = $this->projectRepository->findOneOrFailById($params['project_id']);
            $this->authorize('deleteMember', [
                $project,
                $params['user_id']
            ]);

            $user = $this->userRepository->findOneOrFailById($params['user_id']);

            $project->users()->detach($user);

            return $this->responseUpdated($project);

        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }

    /**
     * @return JsonResponse
     */
    public function getDefaultCollaboratorRole()
    {
        try {
            $role = $this->roleRepository->findOneRoleOrFailByAlias(Project::PROJECT_DEFAULT_ROLE_ALIAS);

            return $this->responseOk($role);
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }
}
