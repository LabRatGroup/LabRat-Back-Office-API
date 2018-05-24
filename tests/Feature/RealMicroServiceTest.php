<?php

namespace Tests\Feature;

use App\Models\MlAlgorithm;
use App\Models\MlModel;
use App\Models\MlModelPrediction;
use App\Models\MlModelState;
use App\Models\Project;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Tests\ApiTestCase;

class RealMicroServiceTest extends ApiTestCase
{
    use RefreshDatabase;

    private const FILE_SIZE = 10000;

    /** @var User */
    private $user;

    /** @var MlModelState */
    private $state;

    /** @var MlModelPrediction */
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
        $state = factory(MlModelState::class)->create(
            [
                'params'    => $this->algorithmParams,
                'file_path' => 'training/data.csv',
                'mime_type' => 'text/cvs',
            ]
        );
        $state->setAlgorithm($this->algorithm);
        $state->setModel($this->model);

        /** @var MlModelPrediction $prediction */
        $prediction = factory(MlModelPrediction::class)->create(
            [
                'params'    => $this->algorithmParams,
                'file_path' => 'training/data.csv',
                'mime_type' => 'text/cvs',
            ]
        );
        $prediction->setModel($this->model);

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
        $response = $this->actingAs($this->user)->postJson(route('api.state.create'), $data);

        // Then
        $response->assertStatus(HttpResponse::HTTP_CREATED);
    }
}
