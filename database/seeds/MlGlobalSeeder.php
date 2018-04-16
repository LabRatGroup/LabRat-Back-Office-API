<?php

use App\Models\MlModel;
use App\Models\MlModelPrediction;
use App\Models\MlModelPredictionData;
use App\Models\MlModelState;
use App\Models\MlModelStateScore;
use Illuminate\Database\Seeder;

class MlGlobalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
