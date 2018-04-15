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

    /** @var MlModelPredictionDataService */
    private $mlModelPredictionDataService;

    /**
     * MlModelService constructor.
     *
     * @param MlModelRepository            $mlModelRepository
     * @param MlModelStateScoreRepository  $mlModelStateScoreRepository
     * @param MlModelPredictionDataService $mlModelPredictionDataService
     */
    public function __construct(MlModelRepository $mlModelRepository, MlModelStateScoreRepository $mlModelStateScoreRepository, MlModelPredictionDataService $mlModelPredictionDataService)
    {
        $this->mlModelRepository = $mlModelRepository;
        $this->mlModelStateScoreRepository = $mlModelStateScoreRepository;
        $this->mlModelPredictionDataService = $mlModelPredictionDataService;
    }

    public function reviewModelPerformance($token)
    {
        /** @var MlModel $model */
        $model = $this->mlModelRepository->findOneOrFailByToken($token);
        $currentState = $model->getCurrentState();

        /** @var MlModelStateScore $topScore */
        $topScore = $this->mlModelStateScoreRepository->getModel();

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

    private function updateModelPredictions(MlModel $model)
    {
        /** @var MlModelPrediction $prediction */
        foreach ($model->predictions as $prediction) {
            $this->mlModelPredictionDataService->update($prediction);
            RunMachineLearningPredictionScript::dispatch($prediction);
        }
    }
}
