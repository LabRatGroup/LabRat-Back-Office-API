<?php

namespace Tests\Feature;

use App\Jobs\RunMachineLearningPredictionScript;
use App\Models\MlAlgorithm;
use App\Models\MlModel;
use App\Models\MlModelPrediction;
use App\Models\MlModelPredictionData;
use App\Models\MlModelState;
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

class MlModelPredictionControllerTest extends ApiTestCase
{
    use RefreshDatabase;

    private const FILE_SIZE = 10000;

    /** @var UploadedFile */
    private $file;

    public function setUp()
    {
        parent::setUp();
        Storage::fake(env('FILESYSTEM_DRIVER'));
        Bus::fake();
        $this->file = UploadedFile::fake()->create('data.csv', self::FILE_SIZE);
    }

    /** @test */
    public function project_user_should_create_model_prediction()
    {
        // Given
        $title = 'PREDICTION_TITLE';

        $user = factory(User::class)->create();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();
        $model->setProject($project);

        /** @var MlAlgorithm $algorithm */
        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create([
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
        ]);

        $data = [
            'title'       => $title,
            'ml_model_id' => $model->id,
            'file'        => $this->file
        ];

        // When
        $response = $this->postJson(route('api.prediction.create'), $data, $this->getAuthHeader($user));

        /** @var MlModelPrediction $predictionDB */
        $predictionDB = MlModelPrediction::find($response->json('data')['id']);

        // Then
        $response->assertStatus(HttpResponse::HTTP_CREATED);
        $this->assertInstanceOf(MlModelPredictionData::class, $predictionDB->predictionData);
        $this->assertDatabaseHas('ml_model_predictions', [
            'ml_model_id' => $model->id,
            'title'       => $title,
        ]);
        Storage::disk(env('FILESYSTEM_DRIVER'))->assertExists($predictionDB->predictionData->file_path);
        Bus::assertDispatched(RunMachineLearningPredictionScript::Class);
    }

    /** @test */
    public function project_team_member_should_create_model_state()
    {
        // Given
        $title = 'PREDICTION_TITLE';

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

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create([
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
        ]);

        $data = [
            'title'       => $title,
            'ml_model_id' => $model->id,
            'file'        => $this->file
        ];

        // When
        $response = $this->postJson(route('api.prediction.create'), $data, $this->getAuthHeader($user));

        /** @var MlModelPrediction $predictionDB */
        $predictionDB = MlModelPrediction::find($response->json('data')['id']);

        // Then
        $response->assertStatus(HttpResponse::HTTP_CREATED);
        $this->assertInstanceOf(MlModelPredictionData::class, $predictionDB->predictionData);
        $this->assertDatabaseHas('ml_model_predictions', [
            'ml_model_id' => $model->id,
            'title'       => $title,
        ]);

        Storage::disk(env('FILESYSTEM_DRIVER'))->assertExists($predictionDB->predictionData->file_path);
        Bus::assertDispatched(RunMachineLearningPredictionScript::Class);
    }

    /** @test */
    public function non_active_state_should_not_create_predictions()
    {
        // Given
        $title = 'PREDICTION_TITLE';

        $user = factory(User::class)->create();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();
        $model->setProject($project);

        /** @var MlAlgorithm $algorithm */
        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create([
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
            'is_current'      => false,
        ]);

        $data = [
            'title'       => $title,
            'ml_model_id' => $model->id,
            'file'        => $this->file
        ];

        // When
        $response = $this->postJson(route('api.prediction.create'), $data, $this->getAuthHeader($user));

        // Then
        $response->assertStatus(HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        $this->assertDatabaseMissing('ml_model_predictions', [
            'ml_model_id' => $model->id,
            'title'       => $title,
        ]);
        Bus::assertNotDispatched(RunMachineLearningPredictionScript::Class);
    }

    /** @test */
    public function non_project_user_should_not_create_model_prediction()
    {
        // Given
        $title = 'PREDICTION_TITLE';

        $user = factory(User::class)->create();
        $nonMember = factory(User::class)->create();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();
        $model->setProject($project);

        /** @var MlAlgorithm $algorithm */
        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create([
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
        ]);

        $data = [
            'title'       => $title,
            'ml_model_id' => $model->id,
            'file'        => $this->file
        ];

        // When
        $response = $this->postJson(route('api.prediction.create'), $data, $this->getAuthHeader($nonMember));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
        $this->assertDatabaseMissing('ml_model_predictions', [
            'ml_model_id' => $model->id,
            'title'       => $title,
        ]);
        Bus::assertNotDispatched(RunMachineLearningPredictionScript::Class);
    }

    /** @test */
    public function project_user_should_update_model_prediction()
    {
        // Given
        $title = 'PREDICTION_TITLE';
        $user = factory(User::class)->create();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();
        $model->setProject($project);

        /** @var MlAlgorithm $algorithm */
        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create([
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
        ]);

        /** @var MlModelPrediction $prediction */
        $prediction = factory(MlModelPrediction::class)->create();
        $prediction->setModel($model);

        /** @var MlModelPredictionData $predictionData */
        $predictionData = factory(MlModelPredictionData::class)->create();
        $prediction->predictionData()->save($predictionData);

        $data = [
            'title' => $title,
            'file'  => $this->file
        ];

        // When
        $response = $this->postJson(route('api.prediction.update', ['id' => $prediction->id]), $data, $this->getAuthHeader($user));

        /** @var MlModelPrediction $predictionDB */
        $predictionDB = MlModelPrediction::find($response->json('data')['id']);

        /** @var Collection $trainingDataItems */
        $predictionDataItems = MlModelPredictionData::all();

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $this->assertInstanceOf(MlModelPredictionData::class, $predictionDB->predictionData);
        $this->assertCount(1, $predictionDataItems);
        $this->assertDatabaseHas('ml_model_predictions', [
            'ml_model_id' => $model->id,
            'title'       => $title,
        ]);
        $this->assertEquals($predictionDataItems->first()->mime_type, $this->file->getMimeType());

        Storage::disk(env('FILESYSTEM_DRIVER'))->assertExists($predictionDB->predictionData->file_path);
        Bus::assertDispatched(RunMachineLearningPredictionScript::Class);
    }

    /** @test */
    public function project_team_member_should_update_model_prediction()
    {
        // Given
        $title = 'PREDICTION_TITLE';
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

        /** @var MlAlgorithm $algorithm */
        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create([
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
        ]);

        /** @var MlModelPrediction $prediction */
        $prediction = factory(MlModelPrediction::class)->create();
        $prediction->setModel($model);

        /** @var MlModelPredictionData $predictionData */
        $predictionData = factory(MlModelPredictionData::class)->create();
        $prediction->predictionData()->save($predictionData);

        $data = [
            'title' => $title,
            'file'  => $this->file
        ];

        // When
        $response = $this->postJson(route('api.prediction.update', ['id' => $prediction->id]), $data, $this->getAuthHeader($member));

        /** @var MlModelPrediction $predictionDB */
        $predictionDB = MlModelPrediction::find($response->json('data')['id']);

        /** @var Collection $trainingDataItems */
        $predictionDataItems = MlModelPredictionData::all();

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $this->assertInstanceOf(MlModelPredictionData::class, $predictionDB->predictionData);
        $this->assertCount(1, $predictionDataItems);
        $this->assertDatabaseHas('ml_model_predictions', [
            'ml_model_id' => $model->id,
            'title'       => $title,
        ]);
        $this->assertEquals($predictionDataItems->first()->mime_type, $this->file->getMimeType());

        Storage::disk(env('FILESYSTEM_DRIVER'))->assertExists($predictionDB->predictionData->file_path);
        Bus::assertDispatched(RunMachineLearningPredictionScript::Class);
    }

    /** @test */
    public function non_active_state_should_not_update_model_prediction()
    {
        // Given
        $title = 'PREDICTION_TITLE';
        $user = factory(User::class)->create();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();
        $model->setProject($project);

        /** @var MlAlgorithm $algorithm */
        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create([
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
            'is_current'      => false,
        ]);

        /** @var MlModelPrediction $prediction */
        $prediction = factory(MlModelPrediction::class)->create();
        $prediction->setModel($model);

        /** @var MlModelPredictionData $predictionData */
        $predictionData = factory(MlModelPredictionData::class)->create();
        $prediction->predictionData()->save($predictionData);

        $data = [
            'title' => $title,
            'file'  => $this->file
        ];

        // When
        $response = $this->postJson(route('api.prediction.update', ['id' => $prediction->id]), $data, $this->getAuthHeader($user));

        /** @var Collection $trainingDataItems */
        $predictionDataItems = MlModelPredictionData::all();

        // Then
        $response->assertStatus(HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        $this->assertCount(1, $predictionDataItems);
        $this->assertDatabaseMissing('ml_model_predictions', [
            'ml_model_id' => $model->id,
            'title'       => $title,
        ]);
        $this->assertNotEquals($predictionDataItems->first()->mime_type, $this->file->getMimeType());
        Bus::assertNotDispatched(RunMachineLearningPredictionScript::Class);
    }

    /** @test */
    public function non_project_user_should_not_update_model_prediction()
    {
        // Given
        $title = 'PREDICTION_TITLE';
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();
        $model->setProject($project);

        /** @var MlAlgorithm $algorithm */
        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create([
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
        ]);

        /** @var MlModelPrediction $prediction */
        $prediction = factory(MlModelPrediction::class)->create();
        $prediction->setModel($model);

        /** @var MlModelPredictionData $predictionData */
        $predictionData = factory(MlModelPredictionData::class)->create();
        $prediction->predictionData()->save($predictionData);

        $data = [
            'title' => $title,
            'file'  => $this->file
        ];

        // When
        $response = $this->postJson(route('api.prediction.update', ['id' => $prediction->id]), $data, $this->getAuthHeader($member));

        /** @var Collection $trainingDataItems */
        $predictionDataItems = MlModelPredictionData::all();

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
        $this->assertCount(1, $predictionDataItems);
        $this->assertDatabaseMissing('ml_model_predictions', [
            'ml_model_id' => $model->id,
            'title'       => $title,
        ]);
        $this->assertNotEquals($predictionDataItems->first()->mime_type, $this->file->getMimeType());
        Bus::assertNotDispatched(RunMachineLearningPredictionScript::Class);
    }

    /** @test */
    public function user_should_delete_model_prediction()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();
        $model->setProject($project);

        /** @var MlAlgorithm $algorithm */
        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create([
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
        ]);

        /** @var MlModelPrediction $prediction */
        $prediction = factory(MlModelPrediction::class)->create();
        $prediction->setModel($model);

        /** @var MlModelPredictionData $predictionData */
        $predictionData = factory(MlModelPredictionData::class)->create();
        $prediction->predictionData()->save($predictionData);

        // When
        $response = $this->deleteJson(route('api.prediction.delete', ['id' => $state->id]), [], $this->getAuthHeader($user));

        /** @var Collection $predictionDataItems */
        $predictionDataItems = MlModelPredictionData::all();

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $this->assertCount(0, $predictionDataItems);
        $this->assertDatabaseHas('project_user', [
            'project_id' => $project->id,
            'user_id'    => $user->id,
            'is_owner'   => 1,
        ]);
        $this->assertSoftDeleted('ml_model_predictions', [
            'id' => $prediction->id,
        ]);
    }

    /** @test */
    public function non_project_user_should_not_delete_model_prediction()
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

        /** @var MlAlgorithm $algorithm */
        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create([
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
        ]);

        /** @var MlModelPrediction $prediction */
        $prediction = factory(MlModelPrediction::class)->create();
        $prediction->setModel($model);

        /** @var MlModelPredictionData $predictionData */
        $predictionData = factory(MlModelPredictionData::class)->create();
        $prediction->predictionData()->save($predictionData);

        // When
        $response = $this->deleteJson(route('api.prediction.delete', ['id' => $state->id]), [], $this->getAuthHeader($member));

        /** @var Collection $predictionDataItems */
        $predictionDataItems = MlModelPredictionData::all();

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
        $this->assertCount(1, $predictionDataItems);
        $this->assertDatabaseHas('ml_model_predictions', [
            'id' => $prediction->id,
        ]);
    }

    /** @test */
    public function project_user_should_list_all_model_predictions()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();
        $model->setProject($project);

        /** @var MlAlgorithm $algorithm */
        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create([
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
        ]);

        /** @var MlModelPrediction $prediction */
        $prediction = factory(MlModelPrediction::class)->create();
        $prediction->setModel($model);

        /** @var MlModelPredictionData $predictionData */
        $predictionData = factory(MlModelPredictionData::class)->create();
        $prediction->predictionData()->save($predictionData);

        // When
        $response = $this->get(route('api.prediction.index', ['id' => $model->id]), $this->getAuthHeader($user));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['title' => $prediction->title]);
    }

    /** @test */
    public function team_member_should_list_all_model_predictions()
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
        $model->setProject($project);

        /** @var MlAlgorithm $algorithm */
        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create([
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
        ]);

        /** @var MlModelPrediction $prediction */
        $prediction = factory(MlModelPrediction::class)->create();
        $prediction->setModel($model);

        /** @var MlModelPredictionData $predictionData */
        $predictionData = factory(MlModelPredictionData::class)->create();
        $prediction->predictionData()->save($predictionData);

        // When
        $response = $this->get(route('api.prediction.index', ['id' => $model->id]), $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['title' => $prediction->title]);
    }

    /** @test */
    public function user_should_not_list_all_model_predictions()
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

        /** @var MlAlgorithm $algorithm */
        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create([
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
        ]);

        /** @var MlModelPrediction $prediction */
        $prediction = factory(MlModelPrediction::class)->create();
        $prediction->setModel($model);

        /** @var MlModelPredictionData $predictionData */
        $predictionData = factory(MlModelPredictionData::class)->create();
        $prediction->predictionData()->save($predictionData);

        // When
        $response = $this->get(route('api.prediction.index', ['id' => $model->id]), $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
    }

    /** @test */
    public function project_user_should_access_model_prediction()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();
        $model->setProject($project);

        /** @var MlAlgorithm $algorithm */
        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create([
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
        ]);

        /** @var MlModelPrediction $prediction */
        $prediction = factory(MlModelPrediction::class)->create();
        $prediction->setModel($model);

        /** @var MlModelPredictionData $predictionData */
        $predictionData = factory(MlModelPredictionData::class)->create();
        $prediction->predictionData()->save($predictionData);

        // When
        $response = $this->get(route('api.prediction.show', ['id' => $prediction->id]), $this->getAuthHeader($user));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['title' => $prediction->title]);
    }

    /** @test */
    public function team_member_should_access_model_prediction()
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
        $model->setProject($project);

        /** @var MlAlgorithm $algorithm */
        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create([
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
        ]);

        /** @var MlModelPrediction $prediction */
        $prediction = factory(MlModelPrediction::class)->create();
        $prediction->setModel($model);

        /** @var MlModelPredictionData $predictionData */
        $predictionData = factory(MlModelPredictionData::class)->create();
        $prediction->predictionData()->save($predictionData);

        // When
        $response = $this->get(route('api.prediction.show', ['id' => $prediction->id]), $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['title' => $prediction->title]);
    }

    /** @test */
    public function user_should_not_list_access_model_prediction()
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

        /** @var MlAlgorithm $algorithm */
        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create([
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
        ]);

        /** @var MlModelPrediction $prediction */
        $prediction = factory(MlModelPrediction::class)->create();
        $prediction->setModel($model);

        /** @var MlModelPredictionData $predictionData */
        $predictionData = factory(MlModelPredictionData::class)->create();
        $prediction->predictionData()->save($predictionData);

        // When
        $response = $this->get(route('api.prediction.show', ['id' => $prediction->id]), $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
    }

    /** @test */
    public function project_user_should_run_prediction()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();
        $model->setProject($project);

        /** @var MlAlgorithm $algorithm */
        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create([
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
        ]);

        /** @var MlModelPrediction $prediction */
        $prediction = factory(MlModelPrediction::class)->create();
        $prediction->setModel($model);

        /** @var MlModelPredictionData $predictionData */
        $predictionData = factory(MlModelPredictionData::class)->create();
        $prediction->predictionData()->save($predictionData);

        // When
        $response = $this->get(route('api.prediction.run', ['id' => $prediction->id]), $this->getAuthHeader($user));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        Bus::assertDispatched(RunMachineLearningPredictionScript::Class);
    }

    /** @test */
    public function project_user_should_run_not_prediction_when_missing_data()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();
        $model->setProject($project);

        /** @var MlAlgorithm $algorithm */
        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create([
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
        ]);

        /** @var MlModelPrediction $prediction */
        $prediction = factory(MlModelPrediction::class)->create();
        $prediction->setModel($model);

        // When
        $response = $this->get(route('api.prediction.run', ['id' => $prediction->id]), $this->getAuthHeader($user));

        // Then
        $response->assertStatus(HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        Bus::assertNotDispatched(RunMachineLearningPredictionScript::Class);
    }

    /** @test */
    public function project_user_should_not_run_prediction_when_missing_current_state()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();
        $model->setProject($project);

        /** @var MlAlgorithm $algorithm */
        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create([
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
            'is_current'      => false,
        ]);

        /** @var MlModelPrediction $prediction */
        $prediction = factory(MlModelPrediction::class)->create();
        $prediction->setModel($model);

        /** @var MlModelPredictionData $predictionData */
        $predictionData = factory(MlModelPredictionData::class)->create();
        $prediction->predictionData()->save($predictionData);

        // When
        $response = $this->get(route('api.prediction.run', ['id' => $prediction->id]), $this->getAuthHeader($user));

        // Then
        $response->assertStatus(HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        Bus::assertNotDispatched(RunMachineLearningPredictionScript::Class);
    }

    /** @test */
    public function non_project_user_should_not_run_prediction()
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

        /** @var MlAlgorithm $algorithm */
        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create([
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
        ]);

        /** @var MlModelPrediction $prediction */
        $prediction = factory(MlModelPrediction::class)->create();
        $prediction->setModel($model);

        /** @var MlModelPredictionData $predictionData */
        $predictionData = factory(MlModelPredictionData::class)->create();
        $prediction->predictionData()->save($predictionData);

        // When
        $response = $this->get(route('api.prediction.run', ['id' => $prediction->id]), $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
        Bus::assertNotDispatched(RunMachineLearningPredictionScript::Class);
    }
}
