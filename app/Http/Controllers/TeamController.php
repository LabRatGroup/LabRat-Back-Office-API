<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequest;
use App\Models\Team;
use App\Repositories\TeamRepository;
use App\Repositories\UserRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class TeamController extends Controller
{
    /** @var TeamRepository */
    private $teamRepository;

    /** @var UserRepository */
    private $userRepository;

    /**
     * TeamController constructor.
     *
     * @param TeamRepository $teamRepository
     * @param UserRepository $userRepository
     */
    public function __construct(TeamRepository $teamRepository, UserRepository $userRepository)
    {
        $this->teamRepository = $teamRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * List all available teams associated to a user.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize('list', Team::class);
        $teams = $this->teamRepository->findAllByUserMember();

        return view('teams.index')
            ->with('teams', $teams);
    }

    /**
     * Shows single team item.
     *
     * @param $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show($id)
    {
        $team = $this->teamRepository->findOneOrFailById($id);
        $this->authorize('view', $team);

        return view('teams.show')
            ->with('team', $team);
    }

    /**
     * Display team creation form.
     *
     * @return View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Team::class);
        $team = $this->teamRepository->getModel();

        return view('teams.form')
            ->with('team', $team);
    }

    /**
     * Creates a new team.
     *
     * @param TeamRequest $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(TeamRequest $request)
    {
        $params = $request->only('name', 'users');
        $this->authorize('create', Team::class);
        $team = $this->teamRepository->create($params);
        $team->setCollaborators($params);

        return redirect()->action('TeamController@index')
            ->with('team', $team);
    }

    /**
     * Team update form.
     *
     * @param $id
     *
     * @return View
     * @throws AuthorizationException
     */
    public function update($id)
    {
        $team = $this->teamRepository->findOneOrFailById($id);
        $this->authorize('update', $team);

        return view('teams.form')
            ->with('team', $team);
    }

    /**
     * Updates team info.
     *
     * @param             $id
     * @param TeamRequest $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function save($id, TeamRequest $request)
    {
        $params = $request->only('name', 'users');
        $team = $this->teamRepository->findOneOrFailById($id);
        $this->authorize('update', $team);
        $team = $this->teamRepository->update($team, $params);
        $team->setCollaborators($params);

        return redirect()->action('TeamController@index')
            ->with('team', $team);
    }

    /**
     * Removes team and relations.
     *
     * @param $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws \Exception
     */
    public function delete($id)
    {
        /** @var Team $team */
        $team = $this->teamRepository->findOneOrFailById($id);
        $this->authorize('delete', $team);
        $this->teamRepository->remove($team);

        return redirect()->action('TeamController@index')
            ->with('team', $team);
    }
}
