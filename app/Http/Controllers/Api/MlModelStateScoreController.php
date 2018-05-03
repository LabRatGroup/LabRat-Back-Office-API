<?php

namespace App\Http\Controllers\Api;

use App\Models\MlModelState;
use App\Repositories\MlModelStateRepository;
use App\Repositories\MlModelStateScoreRepository;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class MlModelStateScoreController extends ApiController
{

    /** @var MlModelStateScoreRepository */
    private $mlModelStateScoreRepository;

    /** @var MlModelStateRepository */
    private $mlModelStateRepository;

    /**
     * MlModelStateScoreController constructor.
     *
     * @param MlModelStateScoreRepository $mlModelStateScoreRepository
     * @param MlModelStateRepository      $mlModelStateRepository
     */
    public function __construct(MlModelStateScoreRepository $mlModelStateScoreRepository, MlModelStateRepository $mlModelStateRepository)
    {
        $this->mlModelStateScoreRepository = $mlModelStateScoreRepository;
        $this->mlModelStateRepository = $mlModelStateRepository;
    }

    /**
     * Sisplays state score.
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

            return $this->responseOk($state->score);
        } catch (AuthorizationException $authorizationException) {
            return $this->responseForbidden($authorizationException->getMessage());
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }
}
