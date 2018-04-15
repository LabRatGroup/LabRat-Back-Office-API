<?php

namespace App\Http\Controllers;

use App\Exceptions\DataFileErrorException;
use App\Http\Controllers\Api\ApiController;
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
use App\Services\MlModelStateTrainingDataService;
use Exception;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MlModelStateController extends ApiController
{
    private const MODEL_STATE_PARAMS_PARAMETER = 'params';
    private const MODEL_ID_PARAMETER = 'ml_model_id';
    private const ALGORITHM_ID_PARAMETER = 'ml_algorithm_id';
    private const TRAINING_DATA_FILE_PARAMETER = 'file';

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

    /**
     * MlModelStateController constructor.
     *
     * @param MlModelStateRepository          $mlModelStateRepository
     * @param MlModelRepository               $mlModelRepository
     * @param MlAlgorithmRepository           $mlAlgorithmRepository
     * @param MlModelStateTrainingDataService $mlModelStateTrainingDataService
     * @param MlModelService                  $mlModelService
     */
    public function __construct(MlModelStateRepository $mlModelStateRepository, MlModelRepository $mlModelRepository, MlAlgorithmRepository $mlAlgorithmRepository, MlModelStateTrainingDataService $mlModelStateTrainingDataService, MlModelService $mlModelService)
    {
        $this->mlModelStateRepository = $mlModelStateRepository;
        $this->mlModelRepository = $mlModelRepository;
        $this->mlAlgorithmRepository = $mlAlgorithmRepository;
        $this->mlModelStateTrainingDataService = $mlModelStateTrainingDataService;
        $this->mlModelService = $mlModelService;
    }

    /**
     * Retrieves all model states by model id.
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

            return $this->responseOk($model->states);
        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }

    /**
     * Displays model state by id.
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function show($id)
    {
        try {
            /** @var MlModelState $state */
            $state = $this->mlModelStateRepository->findOneOrFailById($id);
            $this->authorize('view', $state->model->project);

            return $this->responseOk($state);
        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }

    /**
     * Creates a new model state.
     *
     * @param MlModelStateRequest $request
     *
     * @return JsonResponse
     */
    public function create(MlModelStateRequest $request)
    {
        try {
            $params = $this->getParams($request);

            /** @var MlModel $model */
            $model = $this->mlModelRepository->findOneOrFailById($params[self::MODEL_ID_PARAMETER]);
            $this->authorize('view', $model->project);

            if (!$request->file(self::TRAINING_DATA_FILE_PARAMETER)->isValid()) {
                throw new DataFileErrorException('Training data file was corrupted.');
            }

            $file = $request->file(self::TRAINING_DATA_FILE_PARAMETER);

            /** @var MlAlgorithm $algorithm */
            $algorithm = $this->mlAlgorithmRepository->findOneOrFailById($params[self::ALGORITHM_ID_PARAMETER]);

            /** @var MlModelState $state */
            $state = $this->mlModelStateRepository->create($params);
            $state->setModel($model);
            $state->setAlgorithm($algorithm);

            /** @var MlModelStateTrainingData $modelStateTrainingData */
            $modelStateTrainingData = $this->mlModelStateTrainingDataService->create($file, $state);
            $state->trainingData()->save($modelStateTrainingData);

            RunMachineLearningModelTrainingScript::dispatch($state);

            return $this->responseCreated($state);

        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (DataFileErrorException | Exception $exception) {
            return $this->responseInternalError($exception->getMessage());
        }
    }

    /**
     * Updates a model state and generates a new one.
     *
     * @param                     $id
     * @param Request             $request
     *
     * @return JsonResponse
     */
    public function update($id, Request $request)
    {
        try {
            $params = $this->getParams($request);

            /** @var MlModelState $baseState */
            $baseState = $this->mlModelStateRepository->findOneOrFailById($id);
            $this->authorize('view', $baseState->model->project);

            /** @var MlAlgorithm $algorithm */
            $algorithm = $this->mlAlgorithmRepository->findOneOrFailById($params[self::ALGORITHM_ID_PARAMETER]);

            /** @var MlModelState $state */
            $state = $this->mlModelStateRepository->create($params);
            $state->setModel($baseState->model);
            $state->setAlgorithm($algorithm);

            if ($request->hasFile(self::TRAINING_DATA_FILE_PARAMETER)) {
                if (!$request->file(self::TRAINING_DATA_FILE_PARAMETER)->isValid()) {
                    throw new DataFileErrorException('Training data file was corrupted.');
                }
                $file = $request->file(self::TRAINING_DATA_FILE_PARAMETER);
                $modelStateTrainingData = $this->mlModelStateTrainingDataService->create($file, $state);
            } else {
                /** @var MlModelState $currentState */
                $currentState = $baseState->model->getCurrentState();
                $modelStateTrainingData = $this->mlModelStateTrainingDataService->copy($currentState->trainingData, $state);
            }

            $state->trainingData()->save($modelStateTrainingData);

            RunMachineLearningModelTrainingScript::dispatch($state);

            return $this->responseOk($state);

        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }

    /**
     * Deletes model state.
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function delete($id)
    {
        try {
            /** @var MlModelState $state */
            $state = $this->mlModelStateRepository->findOneOrFailById($id);

            $this->authorize('delete', $state->model->project);
            $this->mlModelStateRepository->delete($state);

            return $this->responseDeleted();
        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }

    /**
     * Set model state to current default for further predictions.
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function current($id)
    {
        try {
            /** @var MlModelState $state */
            $state = $this->mlModelStateRepository->findOneOrFailById($id);

            $this->authorize('update', $state->model->project);
            $state->setAsCurrent();

            $this->mlModelService->reviewModelPerformance($state->model->token);

            return $this->responseOk($state);
        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
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
            self::MODEL_STATE_PARAMS_PARAMETER,
            self::MODEL_ID_PARAMETER,
            self::ALGORITHM_ID_PARAMETER
        ]);
    }
}
