<?php

namespace App\Http\Controllers;

use App\Exceptions\DataFileErrorException;
use App\Http\Requests\MlModelStateRequest;
use App\Jobs\RunMachineLearningModelTrainingScript;
use App\Models\MlAlgorithm;
use App\Models\MlModel;
use App\Models\MlModelState;
use App\Models\MlModelStateTrainingData;
use App\Repositories\MlAlgorithmRepository;
use App\Repositories\MlModelRepository;
use App\Repositories\MlModelStateRepository;
use App\Services\MlModelService;
use App\Services\MlModelStateService;
use App\Services\MlModelStateTrainingDataService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MlModelStateController extends Controller
{
    private const MODEL_ID_PARAMETER = 'ml_model_id';
    private const ALGORITHM_ID_PARAMETER = 'ml_algorithm_id';
    private const TRAINING_DATA_FILE_PARAMETER = 'file';
    private const ALGORITHM_METHOD_ALIAS = 'method';
    private const DATA_RE_PROCESSING_METHOD = 'preprocessing';
    private const MODEL_EVALUATION_METRIC_FACTOR = 'metric';
    private const MODEL_POSITIVE_CLASS = 'positive';
    private const MODEL_RESAMPLING_METHOD = 'control';
    private const ALGORITHM_METHOD_PARAMS = 'tune';
    private const ML_STATE_PARAMS = 'params';
    private const MODEL_STATE_PARAMS_PARAMETER = 'params';


    /** @var MlModelStateRepository */
    private $mlModelStateRepository;

    /** @var MlModelRepository */
    private $mlModelRepository;

    /** @var MlAlgorithmRepository */
    private $mlAlgorithmRepository;

    /** @var MlModelStateTrainingDataService */
    private $mlModelStateTrainingDataService;

    /** @var MlModelService */
    private $mlModelService;

    /** @var MlModelStateService */
    private $mlModelStateService;

    /**
     * MlModelStateController constructor.
     *
     * @param MlModelStateRepository          $mlModelStateRepository
     * @param MlModelRepository               $mlModelRepository
     * @param MlAlgorithmRepository           $mlAlgorithmRepository
     * @param MlModelStateTrainingDataService $mlModelStateTrainingDataService
     * @param MlModelService                  $mlModelService
     * @param MlModelStateService             $mlModelStateService
     */
    public function __construct(MlModelStateRepository $mlModelStateRepository, MlModelRepository $mlModelRepository, MlAlgorithmRepository $mlAlgorithmRepository, MlModelStateTrainingDataService $mlModelStateTrainingDataService, MlModelService $mlModelService, MlModelStateService $mlModelStateService)
    {
        $this->mlModelStateRepository = $mlModelStateRepository;
        $this->mlModelRepository = $mlModelRepository;
        $this->mlAlgorithmRepository = $mlAlgorithmRepository;
        $this->mlModelStateTrainingDataService = $mlModelStateTrainingDataService;
        $this->mlModelService = $mlModelService;
        $this->mlModelStateService = $mlModelStateService;
    }


    /**
     * Retrieves all model states by model id.
     *
     * @param $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function index($id)
    {
        /** @var MlModel $model */
        $model = $this->mlModelRepository->findOneOrFailById($id);
        $this->authorize('view', $model->project);

        return view('mlState.index')
            ->with('states', $model->states);
    }

    /**
     * Displays model state by id.
     *
     * @param $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show($id)
    {
        /** @var MlModelState $state */
        $state = $this->mlModelStateRepository->findOneOrFailById($id);
        $this->authorize('view', $state->model->project);
        return view('mlModelStates.show')
            ->with('state', $state)
            ->with('params', json_decode($state->score->params)[0]);
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws AuthorizationException
     */
    public function create($id)
    {
        /** @var MlModel $model */
        $model = $this->mlModelRepository->findOneOrFailById($id);
        $this->authorize('view', $model->project);

        $state = $this->mlModelStateRepository->getModel();

        return view('mlModelStates.form')
            ->with('state', $state)
            ->with('model', $model);
    }

    /**
     * Creates a new model state.
     *
     * @param MlModelStateRequest $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws DataFileErrorException
     */
    public function store(MlModelStateRequest $request)
    {
        $params = $this->getParams($request);
        $tmp[self::ALGORITHM_METHOD_ALIAS] = $params[self::ALGORITHM_METHOD_ALIAS];
        $tmp[self::DATA_RE_PROCESSING_METHOD] = $params[self::DATA_RE_PROCESSING_METHOD];
        $tmp[self::MODEL_EVALUATION_METRIC_FACTOR] = $params[self::MODEL_EVALUATION_METRIC_FACTOR];
        $tmp[self::MODEL_POSITIVE_CLASS] = $params[self::MODEL_POSITIVE_CLASS];

        $tmp[self::MODEL_RESAMPLING_METHOD] = json_decode($params[self::MODEL_RESAMPLING_METHOD]);
        $tmp[self::ALGORITHM_METHOD_PARAMS] = json_decode($params[self::ALGORITHM_METHOD_PARAMS]);
        $params[self::ML_STATE_PARAMS][] = $tmp;

        $args = [];
        $args[self::MODEL_ID_PARAMETER] =  $params[self::MODEL_ID_PARAMETER];
        $args[self::ALGORITHM_ID_PARAMETER] =  $params[self::ALGORITHM_ID_PARAMETER];
        $args[self::ML_STATE_PARAMS] =  json_encode($params[self::ML_STATE_PARAMS]);

//        dd($args);
        /** @var MlModel $model */
        $model = $this->mlModelRepository->findOneOrFailById($params[self::MODEL_ID_PARAMETER]);
        $this->authorize('view', $model->project);

        if (!$request->file(self::TRAINING_DATA_FILE_PARAMETER)->isValid()) {
            throw new DataFileErrorException('Training data file was corrupted.');
        }

        $file = $request->file(self::TRAINING_DATA_FILE_PARAMETER)->store('training');
        $mime = $request->file(self::TRAINING_DATA_FILE_PARAMETER)->getMimeType();


        if (isset($params[self::ALGORITHM_ID_PARAMETER])) {
            /** @var MlAlgorithm $algorithm */
            $algorithm = $this->mlAlgorithmRepository->findOneOrFailById($params[self::ALGORITHM_ID_PARAMETER]);
        } else {
            $args[self::MODEL_STATE_PARAMS_PARAMETER] = $this->mlModelStateService->generateGlobalPredictionParams($model);
        }

        /** @var MlModelState $state */
        $state = $this->mlModelStateRepository->create($args);
        $state->setModel($model);
        if (isset($algorithm)) $state->setAlgorithm($algorithm);

        /** @var MlModelStateTrainingData $modelStateTrainingData */
        $modelStateTrainingData = $this->mlModelStateTrainingDataService->create($file, $mime, $state);
        $state->trainingData()->save($modelStateTrainingData);

        RunMachineLearningModelTrainingScript::dispatch($state, $this->mlModelService);

        return redirect()->action('ProjectController@index');

    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws AuthorizationException
     */
    public function update($id)
    {
        /** @var MlModelState $baseState */
        $baseState = $this->mlModelStateRepository->findOneOrFailById($id);
        $this->authorize('view', $baseState->model->project);

        return view('mlModelState.form')
            ->with('state', $baseState);
    }

    /**
     * Updates a model state and generates a new one.
     *
     * @param                     $id
     * @param Request             $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws DataFileErrorException
     */
    public function save($id, Request $request)
    {
        $params = $this->getParams($request);

        /** @var MlModelState $baseState */
        $baseState = $this->mlModelStateRepository->findOneOrFailById($id);
        $this->authorize('view', $baseState->model->project);

        if (isset($params[self::ALGORITHM_ID_PARAMETER])) {
            /** @var MlAlgorithm $algorithm */
            $algorithm = $this->mlAlgorithmRepository->findOneOrFailById($params[self::ALGORITHM_ID_PARAMETER]);
        } else {
            $params[self::MODEL_STATE_PARAMS_PARAMETER] = $this->mlModelStateService->generateGlobalPredictionParams($baseState->model);
        }

        /** @var MlModelState $state */
        $state = $this->mlModelStateRepository->create($params);
        $state->setModel($baseState->model);
        if (isset($algorithm)) {
            $state->setAlgorithm($algorithm);
        } else {
            $state->unSetAlgorithm();
        }

        if ($request->hasFile(self::TRAINING_DATA_FILE_PARAMETER)) {
            if (!$request->file(self::TRAINING_DATA_FILE_PARAMETER)->isValid()) {
                throw new DataFileErrorException('Training data file was corrupted.');
            }
            $file = $request->file(self::TRAINING_DATA_FILE_PARAMETER)->store('training');
            $mime = $request->file(self::TRAINING_DATA_FILE_PARAMETER)->getMimeType();

            $modelStateTrainingData = $this->mlModelStateTrainingDataService->create($file, $mime, $state);
        } else {
            /** @var MlModelState $currentState */
            $currentState = $baseState->model->getCurrentState();
            $modelStateTrainingData = $this->mlModelStateTrainingDataService->copy($currentState->trainingData, $state);
        }

        $state->trainingData()->save($modelStateTrainingData);

        RunMachineLearningModelTrainingScript::dispatch($state, $this->mlModelService);

        return redirect()->action('ProjectController@show@index');

    }

    /**
     * Deletes model state.
     *
     * @param $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws \Exception
     */
    public function delete($id)
    {
        /** @var MlModelState $state */
        $state = $this->mlModelStateRepository->findOneOrFailById($id);

        $this->authorize('delete', $state->model->project);
        $this->mlModelStateRepository->delete($state);

        return redirect()->action('MlModelStateController@index')
            ->with('state', $state);
    }

    /**
     * Set model state to current default for further predictions.
     *
     * @param $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function current($id)
    {
        /** @var MlModelState $state */
        $state = $this->mlModelStateRepository->findOneOrFailById($id);

        $this->authorize('update', $state->model->project);
        $state->setAsCurrent();

        $this->mlModelService->reviewModelPerformance($state->model->token);

        return redirect()->action('MlModelStateController@index')
            ->with('state', $state->refresh());
    }

    /**
     * Gets allowed params from request variable.
     *
     * @param Request $request
     *
     * @return array
     */
    private function getParams(Request $request)
    {
        return $request->only([
            self::MODEL_ID_PARAMETER,
            self::ALGORITHM_ID_PARAMETER,
            self::TRAINING_DATA_FILE_PARAMETER,
            self::ALGORITHM_METHOD_ALIAS,
            self::DATA_RE_PROCESSING_METHOD,
            self::MODEL_EVALUATION_METRIC_FACTOR,
            self::MODEL_POSITIVE_CLASS,
            self::MODEL_RESAMPLING_METHOD,
            self::ALGORITHM_METHOD_PARAMS,
        ]);
    }
}
