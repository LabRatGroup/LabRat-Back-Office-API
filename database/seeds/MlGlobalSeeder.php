<?php

use App\Models\MlAlgorithm;
use App\Models\MlModel;
use App\Models\MlModelPrediction;
use App\Models\MlModelPredictionData;
use App\Models\MlModelState;
use App\Models\MlModelStateScore;
use App\Models\MlModelStateTrainingData;
use App\Models\Project;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class MlGlobalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var User $user */
        $user = factory(User::class)->create(
            [
                'name'    => 'Julio Fernandez',
                'email'   => 'jfernandez74@gmail.com',
                'password' => 'decolores',
            ]
        );

        Auth::login($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();
        $model->setProject($project);

        /** @var MlAlgorithm $algorithm */
        $algorithm = MlAlgorithm::where('alias', 'knn')->first();
        $algorithmParams = json_encode(
            [
                'method'        => 'knn',
                'preprocessing' => 'center',
                'metric'        => 'Accuracy',
                'positive'      => 'Cleaved',
                'control'       => [
                    'trainControlMethodRounds' => 10,
                    'trainControlMethod'       => 'cv',
                ],
                'tune'          => [
                    'k' => [
                        'mix'  => 2,
                        'max'  => 8,
                        'step' => 1,
                    ],
                ],
            ]
        );

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create(['params' => $algorithmParams,]);
        $state->setAlgorithm($algorithm);
        $state->setModel($model);

        /** @var MlModelStateScore $score */
        $score = factory(MlModelStateScore::class)->create(
            [
                'params'   => $algorithmParams,
                'accuracy' => 0.8,
            ]
        );
        $score->setState($state);

        /** @var MlModelStateTrainingData $stateTrainingData */
        $stateTrainingData = factory(MlModelStateTrainingData::class)->create(
            [
                'params'    => $state->params,
                'file_path' => 'training/data.csv',
                'mime_type' => 'text/cvs',
            ]
        );
        $stateTrainingData->setState($state);

        /** @var MlModelPrediction $prediction */
        $prediction = factory(MlModelPrediction::class)->create();
        $prediction->setModel($model);

        /** @var MlModelPredictionData $predictionData1 */
        $predictionData = factory(MlModelPredictionData::class)->create(
            [
                'params'    => $state->params,
                'file_path' => 'training/data.csv',
                'mime_type' => 'text/cvs',
            ]
        );
        $predictionData->setPrediction($prediction);
    }
}
