<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\ProjectMemberRequest;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

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
}
