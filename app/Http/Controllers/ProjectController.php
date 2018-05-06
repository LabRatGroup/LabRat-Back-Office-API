<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use App\Repositories\TeamRepository;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * @resource Project
 *           Allows the management or machine learning modeling and prediction of general projects.
 *
 * @package  App\Http\Controllers
 */
class ProjectController extends Controller
{
    /** @var ProjectRepository */
    private $projectRepository;

    /** @var TeamRepository */
    private $teamRepository;

    /**
     * ProjectController constructor.
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
     * Project list
     * Retrieves the list of all available project for which the current user has access to.
     *
     * @return View
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize('list', Project::class);
        $projects = $this->projectRepository->findAllByUserOrTeamMember();

        return view('projects.index')
            ->with('projects', $projects);
    }

    /**
     * Shows single project item.
     *
     * @param $id
     *
     * @return mixed
     * @throws AuthorizationException
     */
    public function show($id)
    {
        $project = $this->projectRepository->findOneOrFailById($id);
        $this->authorize('view', $project);

        return view('projects.show')
            ->with('project', $project);
    }

    /**
     * Display project creation form.
     *
     * @return View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Project::class);
        $project = $this->projectRepository->getModel();
        $teams = $this->teamRepository->findAllByUserMember();

        return view('projects.form')
            ->with('project', $project)
            ->with('teams', $teams);
    }

    /**
     * Creates a new project.
     *
     * @param ProjectRequest $request
     *
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(ProjectRequest $request)
    {
        $params = $request->only([
            'title',
            'description',
            'users',
            'teams',
        ]);
        $this->authorize('create', Project::class);

        /** @var Project $project */
        $project = $this->projectRepository->create($params);
        $project->setCollaborators($params);
        $project->setTeams($params);

        return redirect()->action('ProjectController@index')
            ->with('project', $project);
    }

    /**
     * Project update form.
     *
     * @param $id
     *
     * @return View
     * @throws AuthorizationException
     */
    public function update($id)
    {
        $project = $this->projectRepository->findOneOrFailById($id);
        $this->authorize('update', $project);
        $teams = $this->teamRepository->findAllByUserMember();

        return view('projects.form')
            ->with('project', $project)
            ->with('teams', $teams);
    }

    /**
     * Updates project data.
     *
     * @param         $id
     * @param Request $request
     *
     * @return mixed
     * @throws AuthorizationException
     */
    public function save($id, Request $request)
    {
        $params = $request->only([
            'title',
            'description',
            'users',
            'teams',
        ]);
        $project = $this->projectRepository->findOneOrFailById($id);
        $this->authorize('update', $project);

        /** @var Project $project */
        $project = $this->projectRepository->update($project, $params);
        $project->setCollaborators($params);
        $project->setTeams($params);

        return redirect()->action('ProjectController@index')
            ->with('project', $project);
    }

    /**
     * Soft-deletes project and dependencies.
     *
     * @param $id
     *
     * @return mixed
     * @throws AuthorizationException
     * @throws Exception
     */
    public function delete($id)
    {
        $project = $this->projectRepository->findOneOrFailById($id);
        $this->authorize('delete', $project);
        $this->projectRepository->remove($project);

        return redirect()->action('ProjectController@index')
            ->with('project', $project);
    }
}
