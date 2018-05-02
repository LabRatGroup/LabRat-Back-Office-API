<?php

namespace Tests\Feature;

use App\Models\MlAlgorithm;
use App\Models\MlModel;
use App\Models\MlModelPrediction;
use App\Models\MlModelPredictionData;
use App\Models\MlModelState;
use App\Models\MlModelStateTrainingData;
use App\Models\Project;
use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class RealMicroServiceTest extends TestCase
{
    use RefreshDatabase;

    private const FILE_SIZE = 10000;

    /** @var User */
    private $user;

    /** @var MlModelStateTrainingData */
    private $stateTrainingData;

    /** @var MlModelPredictionData */
    private $predictionData;

    /** @var MlModel */
    private $model;

    private $algorithmParams;

    /** @var MlAlgorithm */
    private $algorithm;

    /** @var UploadedFile */
    private $file;

    public function setUp()
    {
        parent::setUp();

        Storage::fake(env('FILESYSTEM_DRIVER'));

        /** @var User $user */
        $this->user = factory(User::class)->create();
        $this->be($this->user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        $this->model = factory(MlModel::class)->create();
        $this->model->setProject($project);

        $this->algorithm = MlAlgorithm::where('alias', 'knn')->first();
        $this->algorithmParams = json_encode(
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
        $state = factory(MlModelState::class)->create(['params' => $this->algorithmParams,]);
        $state->setAlgorithm($this->algorithm);
        $state->setModel($this->model);

        $this->stateTrainingData = factory(MlModelStateTrainingData::class)->create(
            [
                'params'    => $state->params,
                'file_path' => 'training/data.csv',
                'mime_type' => 'text/cvs',
            ]
        );
        $this->stateTrainingData->setState($state);

        /** @var MlModelPrediction $prediction */
        $prediction = factory(MlModelPrediction::class)->create();
        $prediction->setModel($this->model);

        $this->predictionData = factory(MlModelPredictionData::class)->create(
            [
                'params'    => $state->params,
                'file_path' => 'training/data.csv',
                'mime_type' => 'text/cvs',
            ]
        );
        $this->predictionData->setPrediction($prediction);

        $this->file = UploadedFile::fake()->create('data.csv', self::FILE_SIZE);
    }

    /** @test */
    public function testExample()
    {
        $data = [
            'ml_model_id'     => $this->model->id,
            'ml_algorithm_id' => $this->algorithm->id,
            'params'          => json_encode($this->algorithmParams),
            'file'            => $this->file
        ];

        // When
        $response = $this->actingAs($this->user)->postJson(route('state.create'), $data);
//        dd($response->json());

        // Then
        $response->assertStatus(HttpResponse::HTTP_CREATED);
    }
}
