<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\MlModelStateRequest;
use App\Jobs\RunMachineLearningModelTrainingScript;
use App\Models\MlAlgorithm;
use App\Models\MlModel;
use App\Models\MlModelState;
use App\Repositories\MlAlgorithmRepository;
use App\Repositories\MlModelRepository;
use App\Repositories\MlModelStateRepository;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class MlModelStateController extends ApiController
{
    /** @var MlModelStateRepository */
    private $mlModelStateRepository;

    /** @var MlModelRepository */
    private $mlModelRepository;

    /** @var MlAlgorithmRepository */
    private $mlAlgorithmRepository;

    /**
     * MlModelStateController constructor.
     *
     * @param MlModelStateRepository $mlModelStateRepository
     * @param MlModelRepository      $mlModelRepository
     * @param MlAlgorithmRepository  $mlAlgorithmRepository
     */
    public function __construct(MlModelStateRepository $mlModelStateRepository, MlModelRepository $mlModelRepository, MlAlgorithmRepository $mlAlgorithmRepository)
    {
        $this->mlModelStateRepository = $mlModelStateRepository;
        $this->mlModelRepository = $mlModelRepository;
        $this->mlAlgorithmRepository = $mlAlgorithmRepository;
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
            $params = $request->only([
                'params',
                'ml_model_id',
                'ml_algorithm_id'
            ]);

            /** @var MlModel $model */
            $model = $this->mlModelRepository->findOneOrFailById($params['ml_model_id']);
            $this->authorize('view', $model->project);

            /** @var MlAlgorithm $algorithm */
            $algorithm = $this->mlAlgorithmRepository->findOneOrFailById($params['ml_algorithm_id']);

            /** @var MlModelState $state */
            $state = $this->mlModelStateRepository->create($params);
            $state->setModel($model);
            $state->setAlgorithm($algorithm);

            RunMachineLearningModelTrainingScript::dispatch($state);

            return $this->responseCreated($state);

        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }

    /**
     * Updates a model state and generates a new one.
     *
     * @param MlModelStateRequest $request
     *
     * @return JsonResponse
     */
    public function update(MlModelStateRequest $request)
    {
        try {
            $params = $request->only([
                'params',
                'ml_model_id',
                'ml_algorithm_id'
            ]);

            /** @var MlModel $model */
            $model = $this->mlModelRepository->findOneOrFailById($params['ml_model_id']);
            $this->authorize('view', $model->project);

            /** @var MlAlgorithm $algorithm */
            $algorithm = $this->mlAlgorithmRepository->findOneOrFailById($params['ml_algorithm_id']);

            /** @var MlModelState $state */
            $state = $this->mlModelStateRepository->create($params);
            $state->setModel($model);
            $state->setAlgorithm($algorithm);

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
}
