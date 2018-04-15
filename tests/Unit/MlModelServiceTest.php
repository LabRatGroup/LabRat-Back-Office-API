<?php

namespace Tests\Unit;

use App\Models\MlModel;
use App\Models\MlModelPrediction;
use App\Models\MlModelPredictionData;
use App\Models\MlModelState;
use App\Models\MlModelStateScore;
use App\Repositories\MlModelPredictionDataRepository;
use App\Repositories\MlModelRepository;
use App\Repositories\MlModelStateScoreRepository;
use App\Services\MlModelPredictionDataService;
use App\Services\MlModelService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MlModelServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function should_reschedule_predictions_on_better_performance_model()
    {
        // Given
        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state1 */
        $state1 = factory(MlModelState::class)->create(
            [
                'is_current'  => true,
                'ml_model_id' => $model->id,
            ]
        );

        /** @var MlModelStateScore $score1 */
        $score1 = factory(MlModelStateScore::class)->create(
            [
                'accuracy'          => 0.8,
                'ml_model_state_id' => $state1->id,
            ]
        );

        /** @var MlModelState $state2 */
        $state2 = factory(MlModelState::class)->create(
            [
                'is_current'  => false,
                'ml_model_id' => $model->id,
            ]
        );

        /** @var MlModelStateScore $score1 */
        $score2 = factory(MlModelStateScore::class)->create(
            [
                'accuracy'          => 0.9,
                'ml_model_state_id' => $state2->id,
            ]
        );

        /** @var MlModelPrediction $prediction1 */
        $prediction1 = factory(MlModelPrediction::class)->create(
            [
                'ml_model_id' => $model->id,
            ]
        );

        /** @var MlModelPrediction $prediction2 */
        $prediction2 = factory(MlModelPrediction::class)->create(
            [
                'ml_model_id' => $model->id,
            ]
        );

        /** @var MlModelPredictionData $predictionData1 */
        $predictionData1 = factory(MlModelPredictionData::class)->create(
            [
                'algorithm'           => json_encode($state1->algorithm),
                'params'              => $state1->params,
                'ml_model_prediction_id' => $prediction1->id,
            ]
        );

        /** @var MlModelPredictionData $predictionData1 */
        $predictionData2 = factory(MlModelPredictionData::class)->create(
            [
                'algorithm'           => json_encode($state1->algorithm),
                'params'              => $state1->params,
                'ml_model_prediction_id' => $prediction2->id,
            ]
        );

        /** @var MlModelRepository $mlModelRepository */
        $mlModelRepository = new MlModelRepository(new MlModel());

        /** @var MlModelStateScoreRepository $mlModelStateScoreRepository */
        $mlModelStateScoreRepository = new MlModelStateScoreRepository(new MlModelStateScore());

        /** @var MlModelPredictionDataRepository */
        $mlModelPredictionDataRepository = new MlModelPredictionDataRepository(new MlModelPredictionData());

        /** @var MlModelPredictionDataService $mlModelPredictionDataService */
        $mlModelPredictionDataService = new MlModelPredictionDataService($mlModelPredictionDataRepository);

        /** MlModelService $mlModelService */
        $mlModelService = new MlModelService($mlModelRepository, $mlModelStateScoreRepository, $mlModelPredictionDataService);

        // When
        $mlModelService->reviewModelPerformance($model->token);

        /** @var MlModelPredictionData $predictionDataDB1 */
        $predictionDataDB1 = MlModelPredictionData::find($predictionData1->id);

        /** @var MlModelPredictionData $predictionDataDB2 */
        $predictionDataDB2 = MlModelPredictionData::find($predictionData2->id);

        // Then
        $this->assertDatabaseHas('ml_model_states', [
            'id'         => $state1->id,
            'is_current' => 0,
        ]);

        $this->assertDatabaseHas('ml_model_states', [
            'id'         => $state2->id,
            'is_current' => 1,
        ]);

        $this->assertTrue($predictionDataDB1->params == $state2->params);
        $this->assertTrue($predictionDataDB2->params == $state2->params);
    }
}
