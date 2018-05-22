<?php

namespace App\Http\Controllers;

use App\Exceptions\DataFileErrorException;
use App\Exceptions\UnprocessablePredictionException;
use App\Http\Requests\MlModelPredictionRequest;
use App\Jobs\RunMachineLearningPredictionScript;
use App\Models\MlModel;
use App\Models\MlModelPrediction;
use App\Models\MlModelPredictionData;
use App\Repositories\MlModelPredictionRepository;
use App\Repositories\MlModelRepository;
use App\Services\MlModelPredictionDataService;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MlModelPredictionController extends Controller
{
    private const MODEL_ID_PARAMETER = 'ml_model_id';
    private const PREDICTION_TITLE = 'title';
    private const PREDICTION_DESCRIPTION = 'description';
    private const PREDICTION_DATA_FILE_PARAMETER = 'file';

    /** @var MlModelPredictionRepository */
    private $mlModelPredicionRepository;

    /** @var MlModelPredictionDataService */
    private $mlModelPredictionDataService;

    /** @var MlModelRepository */
    private $mlModelRepository;

    /**
     * MlModelPredictionController constructor.
     *
     * @param MlModelPredictionRepository  $mlModelPredicionRepository
     * @param MlModelPredictionDataService $mlModelPredictionDataService
     * @param MlModelRepository            $mlModelRepository
     */
    public function __construct(MlModelPredictionRepository $mlModelPredicionRepository, MlModelPredictionDataService $mlModelPredictionDataService, MlModelRepository $mlModelRepository)
    {
        $this->mlModelPredicionRepository = $mlModelPredicionRepository;
        $this->mlModelPredictionDataService = $mlModelPredictionDataService;
        $this->mlModelRepository = $mlModelRepository;
    }

    /**
     * Retrieves all model predictions.
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

        return view('predictions.index')
        ->with('predictions', $model->predictions);
    }

    /**
     * Displays model prediction by id.
     *
     * @param $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show($id)
    {
        /** @var MlModelPrediction $prediction */
        $prediction = $this->mlModelPredicionRepository->findOneOrFailById($id);
        $this->authorize('view', $prediction->model->project);

        return view('predictions.show')
            ->with('prediction', $prediction);
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

        $prediction = $this->mlModelPredicionRepository->getModel();

        return view('predictions.form')
            ->with('prediction', $prediction)
            ->with('model', $model);
    }

    /**
     * @param MlModelPredictionRequest $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws DataFileErrorException
     * @throws UnprocessablePredictionException
     */
    public function store(MlModelPredictionRequest $request)
    {
        $params = $this->getParams($request);

        /** @var MlModel $model */
        $model = $this->mlModelRepository->findOneOrFailById($params[self::MODEL_ID_PARAMETER]);
        $this->authorize('view', $model->project);

        if ($model->getCurrentState() === false) {
            throw new UnprocessablePredictionException('No active model state was found for prediction.');
        }

        if (!$request->file(self::PREDICTION_DATA_FILE_PARAMETER)->isValid()) {
            throw new DataFileErrorException('Prediction data file was corrupted.');
        }

        $file = $request->file(self::PREDICTION_DATA_FILE_PARAMETER)->store('predictions');
        $mime = $request->file(self::PREDICTION_DATA_FILE_PARAMETER)->getMimeType();

        /** @var MlModelPrediction $prediction */
        $prediction = $this->mlModelPredicionRepository->create($params);
        $prediction->setModel($model);

        /** @var MlModelPredictionData $modelPredictionData */
        $modelPredictionData = $this->mlModelPredictionDataService->create($prediction, $file, $mime);
        $prediction->predictionData()->save($modelPredictionData);

        RunMachineLearningPredictionScript::dispatch($prediction);

        return redirect()->action('MlModelPredictionController@index', ['id' => $model->id]);
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws AuthorizationException
     */
    public function update($id)
    {
        /** @var MlModelPrediction $prediction */
        $prediction = $this->mlModelPredicionRepository->findOneOrFailById($id);
        $this->authorize('view', $prediction->model->project);

        return view('predictions.form')
            ->with('prediction', $prediction)
            ->with('model', $prediction->model);
    }

    /**
     * Updated current prediction.
     *
     * @param         $id
     * @param Request $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws DataFileErrorException
     * @throws UnprocessablePredictionException
     */
    public function save($id, Request $request)
    {
        $params = $this->getParams($request);

        /** @var MlModelPrediction $prediction */
        $prediction = $this->mlModelPredicionRepository->findOneOrFailById($id);
        $this->authorize('view', $prediction->model->project);

        if ($prediction->model->getCurrentState() === false) {
            throw new UnprocessablePredictionException('No active model state was found for prediction.');
        }

        if (isset($params[self::MODEL_ID_PARAMETER])) {
            /** @var MlModel $model */
            $model = $this->mlModelRepository->findOneOrFailById($params[self::MODEL_ID_PARAMETER]);
            $prediction->setModel($model);
        }

        /** @var MlModelPrediction $prediction */
        $prediction = $this->mlModelPredicionRepository->update($prediction, $params);

        if ($request->hasFile('file')) {
            if (!$request->file(self::PREDICTION_DATA_FILE_PARAMETER)->isValid()) {
                throw new DataFileErrorException('Prediction data file was corrupted.');
            }

            $file = $request->file(self::PREDICTION_DATA_FILE_PARAMETER)->store('predictions');
            $mime = $request->file(self::PREDICTION_DATA_FILE_PARAMETER)->getMimeType();

            /** @var MlModelPredictionData $modelPredictionData */
            $this->mlModelPredictionDataService->update($prediction, $file, $mime);
            $prediction->load('predictionData');
            RunMachineLearningPredictionScript::dispatch($prediction);
        }

        return redirect()->action('MlModelPredictionController@index', ['id' => $model->id]);
    }

    /**
     * Removes prediction.
     *
     * @param $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function delete($id)
    {
        /** @var MlModelPrediction $prediction */
        $prediction = $this->mlModelPredicionRepository->findOneOrFailById($id);
        $model = $prediction->model;

        $this->authorize('view', $prediction->model->project);
        $this->mlModelPredicionRepository->delete($prediction);

        return redirect()->action('MlModelPredictionController@index', ['id' => $model->id]);
    }

    /**
     * Manually re-runs an existing prediction.
     *
     * @param $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws UnprocessablePredictionException
     */
    public function run($id)
    {
        /** @var MlModelPrediction $prediction */
        $prediction = $this->mlModelPredicionRepository->findOneOrFailById($id);

        $this->authorize('view', $prediction->model->project);

        if ($prediction->model->getCurrentState() && $prediction->predictionData) {

            RunMachineLearningPredictionScript::dispatch($prediction);

            return redirect()->action('MlModelPredictionController@index', ['id' => $prediction->model->id]);

        }

        throw new UnprocessablePredictionException('Either the prediction has no data or there are no active model states.');
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
            self::PREDICTION_DATA_FILE_PARAMETER,
            self::PREDICTION_TITLE,
            self::PREDICTION_DESCRIPTION,
            self::MODEL_ID_PARAMETER,
        ]);
    }
}
