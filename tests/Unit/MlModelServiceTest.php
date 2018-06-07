<?php

namespace Tests\Unit;

use App\Jobs\RunMachineLearningPredictionScript;
use App\Models\MlAlgorithm;
use App\Models\MlModel;
use App\Models\MlModelPrediction;
use App\Models\MlModelState;
use App\Models\MlModelStateScore;
use App\Repositories\MlModelPredictionRepository;
use App\Repositories\MlModelRepository;
use App\Repositories\MlModelStateScoreRepository;
use App\Services\MlModelPredictionService;
use App\Services\MlModelService;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MlModelServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function should_reschedule_predictions_on_better_performance_model()
    {

        Queue::fake();

        // Given
        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlAlgorithm $algorithm */
        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        /** @var MlModelState $state1 */
        $state1 = factory(MlModelState::class)->create(
            [
                'is_current'      => true,
                'ml_model_id'     => $model->id,
                'ml_algorithm_id' => $algorithm->id,
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
                'is_current'      => false,
                'ml_model_id'     => $model->id,
                'ml_algorithm_id' => $algorithm->id,
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
                'params'      => $state1->params,
            ]
        );

        /** @var MlModelPrediction $prediction2 */
        $prediction2 = factory(MlModelPrediction::class)->create(
            [
                'ml_model_id' => $model->id,
                'params'      => $state1->params,
            ]
        );

        /** @var MlModelRepository $mlModelRepository */
        $mlModelRepository = new MlModelRepository(new MlModel());

        /** @var MlModelStateScoreRepository $mlModelStateScoreRepository */
        $mlModelStateScoreRepository = new MlModelStateScoreRepository(new MlModelStateScore());

        /** @var MlModelPredictionRepository */
        $mlModelPredictionRepository = new MlModelPredictionRepository(new MlModelPrediction());

        /** @var MlModelPredictionService $mlModelPredictionDataService */
        $mlModelPredictionDataService = new MlModelPredictionService($mlModelPredictionRepository);

        /** MlModelService $mlModelService */
        $mlModelService = new MlModelService($mlModelRepository, $mlModelStateScoreRepository, $mlModelPredictionDataService);

        // When
        $mlModelService->reviewModelPerformance($model->token);

        /** @var MlModelPredictionData $predictionDataDB1 */
        $predictionDataDB1 = MlModelPrediction::find($prediction1->id);

        /** @var MlModelPredictionData $predictionDataDB2 */
        $predictionDataDB2 = MlModelPrediction::find($prediction2->id);

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
        Queue::assertPushed(RunMachineLearningPredictionScript::class, 2);
    }

    /** @test */
    public function should_not_reschedule_predictions_on_same_performance_model()
    {

        Queue::fake();

        // Given
        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlAlgorithm $algorithm */
        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        /** @var MlModelState $state1 */
        $state1 = factory(MlModelState::class)->create(
            [
                'is_current'      => true,
                'ml_model_id'     => $model->id,
                'ml_algorithm_id' => $algorithm->id,
            ]
        );

        /** @var MlModelStateScore $score1 */
        $score1 = factory(MlModelStateScore::class)->create(
            [
                'accuracy'          => 0.87,
                'ml_model_state_id' => $state1->id,
            ]
        );

        /** @var MlModelState $state2 */
        $state2 = factory(MlModelState::class)->create(
            [
                'is_current'      => false,
                'ml_model_id'     => $model->id,
                'ml_algorithm_id' => $algorithm->id,
            ]
        );

        /** @var MlModelStateScore $score1 */
        $score2 = factory(MlModelStateScore::class)->create(
            [
                'accuracy'          => 0.87,
                'ml_model_state_id' => $state2->id,
            ]
        );

        /** @var MlModelPrediction $prediction1 */
        $prediction1 = factory(MlModelPrediction::class)->create(
            [
                'ml_model_id' => $model->id,
                'params'      => $state1->params,
            ]
        );

        /** @var MlModelPrediction $prediction2 */
        $prediction2 = factory(MlModelPrediction::class)->create(
            [
                'ml_model_id' => $model->id,
                'params'      => $state1->params,
            ]
        );

        /** @var MlModelRepository $mlModelRepository */
        $mlModelRepository = new MlModelRepository(new MlModel());

        /** @var MlModelStateScoreRepository $mlModelStateScoreRepository */
        $mlModelStateScoreRepository = new MlModelStateScoreRepository(new MlModelStateScore());

        /** @var MlModelPredictionRepository */
        $mlModelPredictionRepository = new MlModelPredictionRepository(new MlModelPrediction());

        /** @var MlModelPredictionService $mlModelPredictionDataService */
        $mlModelPredictionDataService = new MlModelPredictionService($mlModelPredictionRepository);

        /** MlModelService $mlModelService */
        $mlModelService = new MlModelService($mlModelRepository, $mlModelStateScoreRepository, $mlModelPredictionDataService);

        // When
        $mlModelService->reviewModelPerformance($model->token);

        // Then
        $this->assertDatabaseHas('ml_model_states', [
            'id'         => $state1->id,
            'is_current' => 1,
        ]);

        $this->assertDatabaseHas('ml_model_states', [
            'id'         => $state2->id,
            'is_current' => 0,
        ]);

        Queue::assertNotPushed(RunMachineLearningPredictionScript::class, 2);
    }

    /** @test */
    public function should_set_scored_state_to_current_when_other_failed()
    {

        Queue::fake();

        // Given
        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlAlgorithm $algorithm */
        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        /** @var MlModelState $state1 */
        $state1 = factory(MlModelState::class)->create(
            [
                'is_current'      => false,
                'ml_model_id'     => $model->id,
                'ml_algorithm_id' => $algorithm->id,
            ]
        );


        /** @var MlModelState $state2 */
        $state2 = factory(MlModelState::class)->create(
            [
                'is_current'      => false,
                'ml_model_id'     => $model->id,
                'ml_algorithm_id' => $algorithm->id,
            ]
        );

        /** @var MlModelStateScore $score1 */
        $score2 = factory(MlModelStateScore::class)->create(
            [
                'accuracy'          => 0.9,
                'ml_model_state_id' => $state2->id,
            ]
        );

        /** @var MlModelRepository $mlModelRepository */
        $mlModelRepository = new MlModelRepository(new MlModel());

        /** @var MlModelStateScoreRepository $mlModelStateScoreRepository */
        $mlModelStateScoreRepository = new MlModelStateScoreRepository(new MlModelStateScore());

        /** @var MlModelPredictionRepository */
        $mlModelPredictionRepository = new MlModelPredictionRepository(new MlModelPrediction());

        /** @var MlModelPredictionService $mlModelPredictionDataService */
        $mlModelPredictionDataService = new MlModelPredictionService($mlModelPredictionRepository);

        /** MlModelService $mlModelService */
        $mlModelService = new MlModelService($mlModelRepository, $mlModelStateScoreRepository, $mlModelPredictionDataService);

        // When
        $mlModelService->reviewModelPerformance($model->token);

        // Then
        $this->assertDatabaseHas('ml_model_states', [
            'id'         => $state1->id,
            'is_current' => 0,
        ]);

        $this->assertDatabaseHas('ml_model_states', [
            'id'         => $state2->id,
            'is_current' => 1,
        ]);

        Queue::assertNotPushed(RunMachineLearningPredictionScript::class);
    }

    /** @test */
    public function should_not_set_non_scored_state_to_current_when_other_failed()
    {

        Queue::fake();

        // Given
        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlAlgorithm $algorithm */
        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        /** @var MlModelState $state1 */
        $state1 = factory(MlModelState::class)->create(
            [
                'is_current'      => false,
                'ml_model_id'     => $model->id,
                'ml_algorithm_id' => $algorithm->id,
            ]
        );


        /** @var MlModelState $state2 */
        $state2 = factory(MlModelState::class)->create(
            [
                'is_current'      => false,
                'ml_model_id'     => $model->id,
                'ml_algorithm_id' => $algorithm->id,
            ]
        );

        /** @var MlModelRepository $mlModelRepository */
        $mlModelRepository = new MlModelRepository(new MlModel());

        /** @var MlModelStateScoreRepository $mlModelStateScoreRepository */
        $mlModelStateScoreRepository = new MlModelStateScoreRepository(new MlModelStateScore());

        /** @var MlModelPredictionRepository */
        $mlModelPredictionRepository = new MlModelPredictionRepository(new MlModelPrediction());

        /** @var MlModelPredictionService $mlModelPredictionDataService */
        $mlModelPredictionDataService = new MlModelPredictionService($mlModelPredictionRepository);

        /** MlModelService $mlModelService */
        $mlModelService = new MlModelService($mlModelRepository, $mlModelStateScoreRepository, $mlModelPredictionDataService);

        // When
        $mlModelService->reviewModelPerformance($model->token);

        // Then
        $this->assertDatabaseHas('ml_model_states', [
            'id'         => $state1->id,
            'is_current' => 0,
        ]);

        $this->assertDatabaseHas('ml_model_states', [
            'id'         => $state2->id,
            'is_current' => 0,
        ]);

        Queue::assertNotPushed(RunMachineLearningPredictionScript::class);
    }

    /** @test */
    public function should_not_set_non_scored_state_to_current_when_other_current()
    {

        Queue::fake();

        // Given
        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlAlgorithm $algorithm */
        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        /** @var MlModelState $state1 */
        $state1 = factory(MlModelState::class)->create(
            [
                'is_current'      => true,
                'ml_model_id'     => $model->id,
                'ml_algorithm_id' => $algorithm->id,
            ]
        );

        /** @var MlModelStateScore $score1 */
        $score1 = factory(MlModelStateScore::class)->create(
            [
                'accuracy'          => 0.87,
                'ml_model_state_id' => $state1->id,
            ]
        );


        /** @var MlModelState $state2 */
        $state2 = factory(MlModelState::class)->create(
            [
                'is_current'      => false,
                'ml_model_id'     => $model->id,
                'ml_algorithm_id' => $algorithm->id,
            ]
        );

        /** @var MlModelRepository $mlModelRepository */
        $mlModelRepository = new MlModelRepository(new MlModel());

        /** @var MlModelStateScoreRepository $mlModelStateScoreRepository */
        $mlModelStateScoreRepository = new MlModelStateScoreRepository(new MlModelStateScore());

        /** @var MlModelPredictionRepository */
        $mlModelPredictionRepository = new MlModelPredictionRepository(new MlModelPrediction());

        /** @var MlModelPredictionService $mlModelPredictionDataService */
        $mlModelPredictionDataService = new MlModelPredictionService($mlModelPredictionRepository);

        /** MlModelService $mlModelService */
        $mlModelService = new MlModelService($mlModelRepository, $mlModelStateScoreRepository, $mlModelPredictionDataService);

        // When
        $mlModelService->reviewModelPerformance($model->token);

        // Then
        $this->assertDatabaseHas('ml_model_states', [
            'id'         => $state1->id,
            'is_current' => 1,
        ]);

        $this->assertDatabaseHas('ml_model_states', [
            'id'         => $state2->id,
            'is_current' => 0,
        ]);

        Queue::assertNotPushed(RunMachineLearningPredictionScript::class);
    }

}
