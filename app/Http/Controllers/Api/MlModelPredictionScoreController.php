<?php

namespace App\Http\Controllers\Api;

use App\Models\MlModelPrediction;
use App\Repositories\MlModelPredictionRepository;
use App\Repositories\MlModelPredictionScoreRepository;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class MlModelPredictionScoreController extends ApiController
{
    /** @var MlModelPredictionRepository */
    private $mlModelPredictionRepository;

    /** @var MlModelPredictionScoreRepository */
    private $mlModelPredictionScoreRepository;

    /**
     * MlModelPredictionScoreController constructor.
     *
     * @param MlModelPredictionRepository      $mlModelPredictionRepository
     * @param MlModelPredictionScoreRepository $mlModelPredictionScoreRepository
     */
    public function __construct(MlModelPredictionRepository $mlModelPredictionRepository, MlModelPredictionScoreRepository $mlModelPredictionScoreRepository)
    {
        $this->mlModelPredictionRepository = $mlModelPredictionRepository;
        $this->mlModelPredictionScoreRepository = $mlModelPredictionScoreRepository;
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
