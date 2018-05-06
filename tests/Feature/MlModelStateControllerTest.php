<?php

namespace Tests\Feature;

use App\Jobs\RunMachineLearningModelTrainingScript;
use App\Jobs\RunMachineLearningPredictionScript;
use App\Models\MlAlgorithm;
use App\Models\MlModel;
use App\Models\MlModelPrediction;
use App\Models\MlModelPredictionData;
use App\Models\MlModelState;
use App\Models\MlModelStateScore;
use App\Models\MlModelStateTrainingData;
use App\Models\Project;
use App\Models\Role;
use App\Models\Team;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Tests\ApiTestCase;

class MlModelStateControllerTest extends ApiTestCase
{
    use RefreshDatabase;

    private const FILE_SIZE = 10000;

    private $file;

    public function setUp()
    {
        parent::setUp();
        Storage::fake(env('FILESYSTEM_DRIVER'));
        Bus::fake();
        $this->file = UploadedFile::fake()->create('data.csv', self::FILE_SIZE);
    }

    /** @test */
    public function project_user_should_create_model_state()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();
        $model->setProject($project);

        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        $params = [
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
                    'min'  => 2,
                    'max'  => 8,
                    'step' => 1,
                ],
            ],
        ];

        $data = [
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
            'params'          => json_encode($params),
            'file'            => $this->file
        ];

        // When
        $response = $this->actingAs($user)->postJson(route('api.state.create'), $data);

        /** @var MlModelState $stateDB */
        $stateDB = MlModelState::find($response->json('data')['id']);

        // Then
        $response->assertStatus(HttpResponse::HTTP_CREATED);
        $this->assertInstanceOf(MlModelStateTrainingData::class, $stateDB->trainingData);
        $this->assertDatabaseHas('ml_model_states', [
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
            'params'          => json_encode($params),
        ]);
        Storage::disk(env('FILESYSTEM_DRIVER'))->assertExists($stateDB->trainingData->file_path);
        Bus::assertDispatched(RunMachineLearningModelTrainingScript::Class);
    }

    /** @test */
    public function project_user_should_create_model_state_without_algorithm()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();
        $model->setProject($project);

        $data = [
            'ml_model_id' => $model->id,
            'file'        => $this->file
        ];

        // When
        $response = $this->actingAs($user)->postJson(route('api.state.create'), $data);

        /** @var MlModelState $stateDB */
        $stateDB = MlModelState::find($response->json('data')['id']);

        // Then
        $response->assertStatus(HttpResponse::HTTP_CREATED);
        $response->assertJsonStructure(['data' => ['params']]);
        $this->assertTrue(sizeof(json_decode($response->json('data')['params']), true) > 0);
        $this->assertInstanceOf(MlModelStateTrainingData::class, $stateDB->trainingData);
        $this->assertDatabaseHas('ml_model_states', [
            'ml_model_id' => $model->id,

        ]);
        Storage::disk(env('FILESYSTEM_DRIVER'))->assertExists($stateDB->trainingData->file_path);
        Bus::assertDispatched(RunMachineLearningModelTrainingScript::Class);
    }

    /** @test */
    public function project_team_member_should_create_model_state()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Project::PROJECT_DEFAULT_ROLE_ALIAS)->first();
        $this->be($user);

        /** @var Team $team */
        $team = factory(Team::class)->create();
        $team->users()->attach($member, [
            'is_owner' => 0,
            'role_id'  => $role->id,
        ]);

        /** @var Project $project */
        $project = factory(Project::class)->create();
        $project->teams()->attach($team);

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();
        $model->setProject($project);

        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        $params = [
            'method'        => 'knn',
            'preprocessing' => 'range',
            'metric'        => 'Accuracy',
            'control'       => [
                'trainControlMethodRounds' => 10,
                'trainControlMethod'       => 'cv',
            ],
            'tune'          => [
                'k' => [
                    'min'  => 2,
                    'max'  => 8,
                    'step' => 1,
                ],
            ],
        ];

        $data = [
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
            'params'          => json_encode($params),
            'file'            => $this->file
        ];

        // When
        $response = $this->actingAs($member)->postJson(route('api.state.create'), $data);

        /** @var MlModelState $stateDB */
        $stateDB = MlModelState::find($response->json('data')['id']);

        // Then
        $response->assertStatus(HttpResponse::HTTP_CREATED);
        $this->assertDatabaseHas('ml_model_states', [
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
        ]);
        Storage::disk(env('FILESYSTEM_DRIVER'))->assertExists($stateDB->trainingData->file_path);
        Bus::assertDispatched(RunMachineLearningModelTrainingScript::Class);
    }

    /** @test */
    public function no_access_user_should_not_create_model_state()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();
        $model->setProject($project);

        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        $params = [
            'method'        => 'knn',
            'preprocessing' => 'range',
            'metric'        => 'Accuracy',
            'control'       => [
                'trainControlMethodRounds' => 10,
                'trainControlMethod'       => 'cv',
            ],
            'tune'          => [
                'k' => [
                    'min'  => 2,
                    'max'  => 8,
                    'step' => 1,
                ],
            ],
        ];

        $data = [
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
            'params'          => json_encode($params),
            'file'            => $this->file
        ];

        // When
        $response = $this->actingAs($member)->postJson(route('api.state.create'), $data);

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
        $this->assertDatabaseMissing('ml_model_states', [
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
        ]);
        Bus::assertNotDispatched(RunMachineLearningModelTrainingScript::Class);
    }

    /** @test */
    public function data_file_missing_on_create_model_state()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();
        $model->setProject($project);

        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        $params = [
            'method'        => 'knn',
            'preprocessing' => 'range',
            'metric'        => 'Accuracy',
            'control'       => [
                'trainControlMethodRounds' => 10,
                'trainControlMethod'       => 'cv',
            ],
            'tune'          => [
                'k' => [
                    'min'  => 2,
                    'max'  => 8,
                    'step' => 1,
                ],
            ],
        ];

        $data = [
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
            'params'          => json_encode($params),
        ];

        // When
        $response = $this->actingAs($user)->postJson(route('api.state.create'), $data);

        // Then
        $response->assertStatus(HttpResponse::HTTP_UNPROCESSABLE_ENTITY);
        $this->assertDatabaseMissing('ml_model_states', [
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
            'params'          => json_encode($params),
        ]);
        Bus::assertNotDispatched(RunMachineLearningModelTrainingScript::Class);
    }

    /** @test */
    public function user_should_delete_model_state()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create();

        $model->setProject($project);
        $state->setModel($model);

        // When
        $response = $this->actingAs($user)->deleteJson(route('api.state.delete', ['id' => $state->id]), []);

        /** @var Collection $trainingDataItems */
        $trainingDataItems = MlModelStateTrainingData::all();

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $this->assertCount(0, $trainingDataItems);
        $this->assertDatabaseHas('project_user', [
            'project_id' => $project->id,
            'user_id'    => $user->id,
            'is_owner'   => 1,
        ]);
        $this->assertSoftDeleted('ml_model_states', [
            'id' => $state->id,
        ]);
    }

    /** @test */
    public function non_project_owner_should_not_delete_model_state()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create();

        $model->setProject($project);
        $state->setModel($model);

        // When
        $response = $this->actingAs($member)->deleteJson(route('api.state.delete', ['id' => $state->id]), []);

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
        $this->assertDatabaseHas('project_user', [
            'project_id' => $project->id,
            'user_id'    => $user->id,
            'is_owner'   => 1,
        ]);
        $this->assertDatabaseHas('ml_model_states', [
            'id'         => $state->id,
            'deleted_at' => null,
        ]);
    }

    /** @test */
    public function project_user_should_list_all_model_states()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Project::PROJECT_DEFAULT_ROLE_ALIAS)->first();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();
        $project->users()->attach($member, ['role_id' => $role->id]);

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create();

        $model->setProject($project);
        $state->setModel($model);

        // When
        $response = $this->actingAs($member)->get(route('api.state.index', ['id' => $model->id]));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['params' => $state->params]);
    }

    /** @test */
    public function team_member_should_list_all_model_states()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Team::TEAM_DEFAULT_ROLE_ALIAS)->first();
        $this->be($user);

        /** @var Team $team */
        $team = factory(Team::class)->create();
        $team->users()->attach($member, ['role_id' => $role->id]);

        /** @var Project $project */
        $project = factory(Project::class)->create();
        $team->projects()->attach($project);

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create();

        $model->setProject($project);
        $state->setModel($model);

        // When
        $response = $this->actingAs($member)->get(route('api.state.index', ['id' => $model->id]));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['params' => $state->params]);
    }

    /** @test */
    public function user_should_not_list_all_model_states()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create();

        $model->setProject($project);
        $state->setModel($model);

        // When
        $response = $this->actingAs($member)->get(route('api.state.index', ['id' => $model->id]));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
    }

    /** @test */
    public function project_user_should_access_model_state()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Project::PROJECT_DEFAULT_ROLE_ALIAS)->first();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();
        $project->users()->attach($member, ['role_id' => $role->id]);

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create();

        $model->setProject($project);
        $state->setModel($model);

        // When
        $response = $this->actingAs($member)->get(route('api.state.show', ['id' => $model->id]));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['params' => $state->params]);
    }

    /** @test */
    public function team_member_should_access_model_state()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Team::TEAM_DEFAULT_ROLE_ALIAS)->first();
        $this->be($user);

        /** @var Team $team */
        $team = factory(Team::class)->create();
        $team->users()->attach($member, ['role_id' => $role->id]);

        /** @var Project $project */
        $project = factory(Project::class)->create();
        $team->projects()->attach($project);

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create();

        $model->setProject($project);
        $state->setModel($model);

        // When
        $response = $this->actingAs($member)->get(route('api.state.show', ['id' => $model->id]));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['params' => $state->params]);
    }

    /** @test */
    public function user_should_not_access_all_model_state()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create();

        $model->setProject($project);
        $state->setModel($model);

        // When
        $response = $this->actingAs($member)->get(route('api.state.show', ['id' => $model->id]));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
    }

    /** @test */
    public function project_user_should_update_state()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Project::PROJECT_DEFAULT_ROLE_ALIAS)->first();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();
        $project->users()->attach($member, ['role_id' => $role->id]);

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create();

        /** @var MlModelStateTrainingData $trainingData */
        $trainingData = factory(MlModelStateTrainingData::class)->create();

        $model->setProject($project);
        $state->setModel($model);
        $state->trainingData()->save($trainingData);

        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        $params = [
            'method'        => 'knn',
            'preprocessing' => 'range',
            'metric'        => 'Accuracy',
            'control'       => [
                'trainControlMethodRounds' => 10,
                'trainControlMethod'       => 'cv',
            ],
            'tune'          => [
                'k' => [
                    'min'  => 2,
                    'max'  => 8,
                    'step' => 1,
                ],
            ],
        ];

        $data = [
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
            'params'          => json_encode($params),
            'file'            => $this->file,
        ];

        // When
        $response = $this->actingAs($member)->post(route('api.state.update', ['id' => $state->id]), $data);

        /** @var Collection $trainingDataItems */
        $trainingDataItems = MlModelStateTrainingData::all();

        /** @var MlModelState $stateDB */
        $stateDB = MlModelState::find($response->json('data')['id']);

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['params' => json_encode($params)]);

        $this->assertCount(2, $model->states);
        $this->assertCount(2, $trainingDataItems);


        Storage::disk(env('FILESYSTEM_DRIVER'))->assertExists($stateDB->trainingData->file_path);
        Bus::assertDispatched(RunMachineLearningModelTrainingScript::Class);
    }

    /** @test */
    public function project_user_should_update_state_without_algorithm()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Project::PROJECT_DEFAULT_ROLE_ALIAS)->first();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();
        $project->users()->attach($member, ['role_id' => $role->id]);

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create();

        /** @var MlModelStateTrainingData $trainingData */
        $trainingData = factory(MlModelStateTrainingData::class)->create();

        $model->setProject($project);
        $state->setModel($model);
        $state->trainingData()->save($trainingData);


        $data = [
            'ml_model_id'     => $model->id,
            'file'            => $this->file,
        ];

        // When
        $response = $this->actingAs($member)->post(route('api.state.update', ['id' => $state->id]), $data);

        /** @var Collection $trainingDataItems */
        $trainingDataItems = MlModelStateTrainingData::all();

        /** @var MlModelState $stateDB */
        $stateDB = MlModelState::find($response->json('data')['id']);

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonStructure(['data' => ['params']]);
        $this->assertTrue(sizeof(json_decode($response->json('data')['params']), true) > 0);

        $this->assertCount(2, $model->states);
        $this->assertCount(2, $trainingDataItems);


        Storage::disk(env('FILESYSTEM_DRIVER'))->assertExists($stateDB->trainingData->file_path);
        Bus::assertDispatched(RunMachineLearningModelTrainingScript::Class);
    }

    /** @test */
    public function project_user_should_update_state_without_file()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Project::PROJECT_DEFAULT_ROLE_ALIAS)->first();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();
        $project->users()->attach($member, ['role_id' => $role->id]);

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create();

        /** @var MlModelStateTrainingData $trainingData */
        $trainingData = factory(MlModelStateTrainingData::class)->create();

        $model->setProject($project);
        $state->setModel($model);
        $state->trainingData()->save($trainingData);

        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        $params = [
            'method'        => 'knn',
            'preprocessing' => 'range',
            'metric'        => 'Accuracy',
            'control'       => [
                'trainControlMethodRounds' => 10,
                'trainControlMethod'       => 'cv',
            ],
            'tune'          => [
                'k' => [
                    'min'  => 2,
                    'max'  => 8,
                    'step' => 1,
                ],
            ],
        ];

        $data = [
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
            'params'          => json_encode($params),
        ];

        // When
        $response = $this->actingAs($member)->post(route('api.state.update', ['id' => $state->id]), $data);

        /** @var Collection $trainingDataItems */
        $trainingDataItems = MlModelStateTrainingData::all();

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['params' => json_encode($params)]);

        $this->assertCount(2, $model->states);
        $this->assertCount(2, $trainingDataItems);
        Bus::assertDispatched(RunMachineLearningModelTrainingScript::Class);
    }

    /** @test */
    public function project_member_user_should_update_state()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Team::TEAM_DEFAULT_ROLE_ALIAS)->first();
        $this->be($user);

        /** @var Team $team */
        $team = factory(Team::class)->create();
        $team->users()->attach($member, ['role_id' => $role->id]);

        /** @var Project $project */
        $project = factory(Project::class)->create();
        $team->projects()->attach($project);

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create();

        $model->setProject($project);
        $state->setModel($model);

        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        $params = [
            'method'        => 'knn',
            'preprocessing' => 'range',
            'metric'        => 'Accuracy',
            'control'       => [
                'trainControlMethodRounds' => 10,
                'trainControlMethod'       => 'cv',
            ],
            'tune'          => [
                'k' => [
                    'min'  => 2,
                    'max'  => 8,
                    'step' => 1,
                ],
            ],
        ];

        $data = [
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
            'params'          => json_encode($params),
            'file'            => $this->file,
        ];

        // When
        $response = $this->actingAs($member)->post(route('api.state.update', ['id' => $state->id]), $data);

        /** @var MlModelState $stateDB */
        $stateDB = MlModelState::find($response->json('data')['id']);

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['params' => json_encode($params)]);

        $this->assertCount(2, $model->states);

        Storage::disk(env('FILESYSTEM_DRIVER'))->assertExists($stateDB->trainingData->file_path);
        Bus::assertDispatched(RunMachineLearningModelTrainingScript::Class);
    }

    /** @test */
    public function user_should_not_update_state()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $this->be($user);

        /** @var Team $team */
        $team = factory(Team::class)->create();

        /** @var Project $project */
        $project = factory(Project::class)->create();
        $team->projects()->attach($project);

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create();

        $model->setProject($project);
        $state->setModel($model);

        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        $params = [
            'method'        => 'knn',
            'preprocessing' => 'range',
            'metric'        => 'Accuracy',
            'control'       => [
                'trainControlMethodRounds' => 10,
                'trainControlMethod'       => 'cv',
            ],
            'tune'          => [
                'k' => [
                    'min'  => 2,
                    'max'  => 8,
                    'step' => 1,
                ],
            ],
        ];

        $data = [
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
            'params'          => json_encode($params),
            'file'            => $this->file,
        ];

        // When
        $response = $this->actingAs($member)->post(route('api.state.update', ['id' => $state->id]), $data);

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
        $this->assertCount(1, $model->states);
        Bus::assertNotDispatched(RunMachineLearningModelTrainingScript::Class);
    }

    public function project_user_should_set_model_state_as_active()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        /** @var MlAlgorithm $algorithm */
        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state1 */
        $state1 = factory(MlModelState::class)->create(['is_current' => true]);

        /** @var MlModelState $state2 */
        $state2 = factory(MlModelState::class)->create(['is_current' => false]);

        /** @var MlModelStateScore $score1 */
        $score1 = factory(MlModelStateScore::class)->create();

        /** @var MlModelStateScore $score2 */
        $score2 = factory(MlModelStateScore::class)->create();

        /** @var MlModelPrediction $prediction1 */
        $prediction1 = factory(MlModelPrediction::class)->create();

        /** @var MlModelPrediction $prediction2 */
        $prediction2 = factory(MlModelPrediction::class)->create();

        /** @var MlModelPredictionData $predictionData1 */
        $predictionData1 = factory(MlModelPredictionData::class)->create();

        /** @var MlModelPredictionData $predictionData2 */
        $predictionData2 = factory(MlModelPredictionData::class)->create();

        $model->setProject($project);

        $state1->setModel($model);
        $state1->setAlgorithm($algorithm);

        $state2->setModel($model);
        $state2->setAlgorithm($algorithm);

        $score1->setState($state1);
        $score2->setState($state2);

        $prediction1->setModel($model);
        $prediction2->setModel($model);

        $predictionData1->setPrediction($prediction1);
        $predictionData2->setPrediction($prediction2);

        // When
        $response = $this->actingAs($user)->post(route('api.state.current', ['id' => $state2->id]), []);

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);

        $response->assertJson(['data' => ['is_current' => '1']]);
        $this->assertDatabaseHas('ml_model_states', [
            'id'         => $state1->id,
            'is_current' => 0,
        ]);
        $this->assertDatabaseHas('ml_model_states', [
            'id'         => $state2->id,
            'is_current' => 1,
        ]);
        Bus::assertDispatched(RunMachineLearningPredictionScript::Class);
    }

    /** @test */
    public function non_project_user_should_not_set_model_state_as_active()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $this->be($user);

        /** @var Team $team */
        $team = factory(Team::class)->create();

        /** @var Project $project */
        $project = factory(Project::class)->create();
        $team->projects()->attach($project);

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state1 */
        $state1 = factory(MlModelState::class)->create(['is_current' => true]);

        /** @var MlModelState $state2 */
        $state2 = factory(MlModelState::class)->create(['is_current' => false]);

        $model->setProject($project);
        $state1->setModel($model);
        $state2->setModel($model);

        // When
        $response = $this->actingAs($member)->post(route('api.state.current', ['id' => $state2->id]), []);

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
        $this->assertDatabaseHas('ml_model_states', [
            'id'         => $state1->id,
            'is_current' => 1,
        ]);
        $this->assertDatabaseHas('ml_model_states', [
            'id'         => $state2->id,
            'is_current' => 0,
        ]);
        Bus::assertNotDispatched(RunMachineLearningModelTrainingScript::Class);
    }
}
