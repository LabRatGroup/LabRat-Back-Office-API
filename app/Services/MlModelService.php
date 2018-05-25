<?php

namespace App\Services;

use App\Jobs\RunMachineLearningPredictionScript;
use App\Models\MlModel;
use App\Models\MlModelPrediction;
use App\Models\MlModelState;
use App\Models\MlModelStateScore;
use App\Repositories\MlModelRepository;
use App\Repositories\MlModelStateScoreRepository;

class MlModelService
{
    /** @var MlModelRepository */
    private $mlModelRepository;

    /** @var MlModelStateScoreRepository */
    private $mlModelStateScoreRepository;

    /** @var MlModelPredictionService */
    private $mlModelPredictionService;

    /**
     * MlModelService constructor.
     *
     * @param MlModelRepository           $mlModelRepository
     * @param MlModelStateScoreRepository $mlModelStateScoreRepository
     * @param MlModelPredictionService    $mlModelPredictionService
     */
    public function __construct(MlModelRepository $mlModelRepository, MlModelStateScoreRepository $mlModelStateScoreRepository, MlModelPredictionService $mlModelPredictionService)
    {
        $this->mlModelRepository = $mlModelRepository;
        $this->mlModelStateScoreRepository = $mlModelStateScoreRepository;
        $this->mlModelPredictionService = $mlModelPredictionService;
    }

    public function reviewModelPerformance($token)
    {
        /** @var MlModel $model */
        $model = $this->mlModelRepository->findOneOrFailByToken($token);
        $currentState = $model->getCurrentState();

        /** @var MlModelStateScore $topScore */
        $topScore = $currentState->score;

        /** @var MlModelState $state */
        foreach ($model->states as $state) {
            if ($state->score->getPerformanceParamValue() > $topScore->getPerformanceParamValue()) {
                $topScore = $state->score;
            }
        }

        if ($topScore->state->token != $currentState->token) {
            $topScore->state->setIsCurrent(true);
            $currentState->setIsCurrent(false);
            $this->updateModelPredictions($model);
        }
    }

    public function updateModelPredictions(MlModel $model)
    {
        /** @var MlModelPrediction $prediction */
        foreach ($model->predictions as $prediction) {
            $prediction->code = null;
            $this->mlModelPredictionService->update($prediction);
            RunMachineLearningPredictionScript::dispatch($prediction);
        }
    }
}
