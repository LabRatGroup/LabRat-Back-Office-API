<?php

namespace App\Http\Controllers;

use App\Exceptions\DataFileErrorException;
use App\Exceptions\UnprocessablePredictionException;
use App\Http\Controllers\Api\ApiController;
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

class MlModelPredictionController extends ApiController
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
     */
    public function index($id)
    {
        try {
            /** @var MlModel $model */
            $model = $this->mlModelRepository->findOneOrFailById($id);
            $this->authorize('view', $model->project);

            return $this->responseOk($model->predictions);
        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }

    /**
     * Displays model prediction by id.
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function show($id)
    {
        try {
            /** @var MlModelPrediction $prediction */
            $prediction = $this->mlModelPredicionRepository->findOneOrFailById($id);
            $this->authorize('view', $prediction->model->project);

            return $this->responseOk($prediction);
        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }

    /**
     * @param MlModelPredictionRequest $request
     *
     * @return JsonResponse
     */
    public function create(MlModelPredictionRequest $request)
    {
        try {
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

            $file = $request->file(self::PREDICTION_DATA_FILE_PARAMETER);

            /** @var MlModelPrediction $prediction */
            $prediction = $this->mlModelPredicionRepository->create($params);
            $prediction->setModel($model);

            /** @var MlModelPredictionData $modelPredictionData */
            $modelPredictionData = $this->mlModelPredictionDataService->create($prediction, $file);
            $prediction->predictionData()->save($modelPredictionData);

            RunMachineLearningPredictionScript::dispatch($prediction);

            return $this->responseCreated($prediction);

        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (DataFileErrorException | UnprocessablePredictionException | Exception $exception) {
            return $this->responseInternalError($exception->getMessage());
        }
    }

    /**
     * Updated current prediction.
     *
     * @param         $id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function update($id, Request $request)
    {
        try {
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

                $file = $request->file(self::PREDICTION_DATA_FILE_PARAMETER);

                /** @var MlModelPredictionData $modelPredictionData */
                $this->mlModelPredictionDataService->update($prediction, $file);
                $prediction->load('predictionData');
                RunMachineLearningPredictionScript::dispatch($prediction);
            }

            return $this->responseOk($prediction);
        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (DataFileErrorException | UnprocessablePredictionException | Exception $exception) {
            return $this->responseInternalError($exception->getMessage());
        }
    }

    /**
     * Removes prediction.
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function delete($id)
    {
        try {
            /** @var MlModelPrediction $prediction */
            $prediction = $this->mlModelPredicionRepository->findOneOrFailById($id);

            $this->authorize('view', $prediction->model->project);
            $this->mlModelPredicionRepository->delete($prediction);

            return $this->responseDeleted();
        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }

    /**
     * Manually re-runs an existing prediction.
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function run($id)
    {
        try {
            /** @var MlModelPrediction $prediction */
            $prediction = $this->mlModelPredicionRepository->findOneOrFailById($id);

            $this->authorize('view', $prediction->model->project);

            if ($prediction->model->getCurrentState() && $prediction->predictionData) {

                RunMachineLearningPredictionScript::dispatch($prediction);

                return $this->responseOk($prediction);
            }

            throw new UnprocessablePredictionException('Either the prediction has no data or there are no active model states.');

        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (UnprocessablePredictionException | Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
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
