<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiController;
use App\Models\MlModelPrediction;
use App\Repositories\MlModelPredictionRepository;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class MlModelPredictionScoreController extends ApiController
{
    /** @var MlModelPredictionRepository */
    private $mlModelPredictionRepository;

    /**
     * MlModelPredictionScoreController constructor.
     *
     * @param MlModelPredictionRepository $mlModelPredictionRepository
     */
    public function __construct(MlModelPredictionRepository $mlModelPredictionRepository)
    {
        $this->mlModelPredictionRepository = $mlModelPredictionRepository;
    }

    /**
     * Displays prediction score data.
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function show($id)
    {
        try {
            /** @var MlModelPrediction $prediction */
            $prediction = $this->mlModelPredictionRepository->findOneOrFailById($id);
            $this->authorize('view', $prediction->model->project);

            return $this->responseOk($prediction->score);

        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }
}
