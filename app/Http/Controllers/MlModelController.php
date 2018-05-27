<?php

namespace App\Http\Controllers;

use App\Http\Requests\MlModelRequest;
use App\Models\MlModel;
use App\Models\Project;
use App\Repositories\MlModelRepository;
use App\Repositories\ProjectRepository;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MlModelController extends Controller
{
    /**
     * @var MlModelRepository
     */
    private $mlModelRepository;

    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    /**
     * MlModelController constructor.
     *
     * @param MlModelRepository $mlModelRepository
     * @param ProjectRepository $projectRepository
     */
    public function __construct(MlModelRepository $mlModelRepository, ProjectRepository $projectRepository)
    {
        $this->mlModelRepository = $mlModelRepository;
        $this->projectRepository = $projectRepository;
    }

    /**
     * Display al models.
     *
     * @param $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function index($id)
    {
        /** @var Project $project */
        $project = $this->projectRepository->findOneOrFailById($id);
        $this->authorize('view', $project);

        return view('mlModels.index')
            ->with('models', $project->models);
    }

    /**
     * Display model details.
     *
     * @param $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show($id)
    {
        /** @var MlModel $model */
        $model = $this->mlModelRepository->findOneOrFailById($id);
        $this->authorize('view', $model->project);

        return view('mlModels.show')
            ->with('model', $model)
            ->with('currentState', $model->getCurrentState());
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws AuthorizationException
     */
    public function create($id)
    {
        /** @var Project $project */
        $project = $this->projectRepository->findOneOrFailById($id);
        $this->authorize('update', $project);

        $model = $this->projectRepository->getModel();

        return view('mlModels.form')
            ->with('model', $model)
            ->with('project', $project);
    }

    /**
     * Creates a new ml model.
     *
     * @param MlModelRequest $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(MlModelRequest $request)
    {
        $params = $request->only([
            'title',
            'description',
            'project_id',
            'positive',
        ]);

        /** @var Project $project */
        $project = $this->projectRepository->findOneOrFailById($params['project_id']);
        $this->authorize('update', $project);
        /** @var MlModel $model */
        $model = $this->mlModelRepository->create($params);
        $model->setProject($project);

        return redirect()->action('ProjectController@index')
            ->with('model', $model);
    }

    /**
     * Project update form.
     *
     * @param $id
     *
     * @return bool
     * @throws AuthorizationException
     */
    public function update($id)
    {
        /** @var MlModel $model */
        $model = $this->mlModelRepository->findOneOrFailById($id);
        $this->authorize('update', $model->project);

        return view('mlModels.form')
            ->with('model', $model)
            ->with('project', $model->project);
    }

    /**
     * Updates current model.
     *
     * @param         $id
     * @param Request $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function save($id, Request $request)
    {
        $params = $request->only([
            'title',
            'description',
            'project_id',
            'positive',
        ]);
        /** @var MlModel $model */
        $model = $this->mlModelRepository->findOneOrFailById($id);
        $this->authorize('update', $model->project);
        if ($params['project_id']) {
            /** @var Project $project */
            $project = $this->projectRepository->findOneOrFailById($params['project_id']);
            $model->setProject($project);
        }

        $model = $this->mlModelRepository->update($model, $params);

        return redirect()->action('ProjectController@index')
            ->with('model', $model);
    }

    /**
     * Deletes model.
     *
     * @param $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws Exception
     */
    public function delete($id)
    {
        /** @var MlModel $model */
        $model = $this->mlModelRepository->findOneOrFailById($id);
        $this->authorize('delete', $model->project);
        $this->mlModelRepository->delete($model);

        return redirect()->action('ProjectController@index')
            ->with('model', $model);
    }
}
