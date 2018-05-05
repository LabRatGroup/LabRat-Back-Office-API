<?php

namespace Tests\Feature;

use App\Models\MlModel;
use App\Models\MlModelPrediction;
use App\Models\MlModelPredictionData;
use App\Models\MlModelPredictionScore;
use App\Models\MlModelState;
use App\Models\Project;
use App\Models\Role;
use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Tests\ApiTestCase;

class MlModelPredictionScoreControllerTest extends ApiTestCase
{
    use RefreshDatabase;

    /** @test */
    public function project_user_should_show_prediction_score()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create(['is_current' => true]);

        /** @var MlModelPrediction $prediction */
        $prediction = factory(MlModelPrediction::class)->create();

        /** @var MlModelPredictionData $predictionData */
        $predictionData = factory(MlModelPredictionData::class)->create();

        /** @var MlModelPredictionScore $predictionScore */
        $predictionScore = factory(MlModelPredictionScore::class)->create();

        $model->setProject($project);
        $state->setModel($model);
        $prediction->setModel($model);
        $predictionData->setPrediction($prediction);
        $predictionScore->setPrediction($prediction);

        // When
        $response = $this->get(route('api.score.prediction.show', ['id' => $prediction->id]), $this->getAuthHeader($user));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['_id' => $predictionScore->id]);
    }

    /** @test */
    public function project_team_user_should_show_prediction_score()
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
        $project->teams()->attach($team);

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create(['is_current' => true]);

        /** @var MlModelPrediction $prediction */
        $prediction = factory(MlModelPrediction::class)->create();

        /** @var MlModelPredictionData $predictionData */
        $predictionData = factory(MlModelPredictionData::class)->create();

        /** @var MlModelPredictionScore $predictionScore */
        $predictionScore = factory(MlModelPredictionScore::class)->create();

        $model->setProject($project);
        $state->setModel($model);
        $prediction->setModel($model);
        $predictionData->setPrediction($prediction);
        $predictionScore->setPrediction($prediction);

        // When
        $response = $this->get(route('api.score.prediction.show', ['id' => $prediction->id]), $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['_id' => $predictionScore->id]);
    }

    /** @test */
    public function non_project_user_should_not_show_prediction_score()
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
        $state = factory(MlModelState::class)->create(['is_current' => true]);

        /** @var MlModelPrediction $prediction */
        $prediction = factory(MlModelPrediction::class)->create();

        /** @var MlModelPredictionData $predictionData */
        $predictionData = factory(MlModelPredictionData::class)->create();

        /** @var MlModelPredictionScore $predictionScore */
        $predictionScore = factory(MlModelPredictionScore::class)->create();

        $model->setProject($project);
        $state->setModel($model);
        $prediction->setModel($model);
        $predictionData->setPrediction($prediction);
        $predictionScore->setPrediction($prediction);

        // When
        $response = $this->get(route('api.score.prediction.show', ['id' => $prediction->id]), $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
    }

    /** @test */
    public function project_user_should_delete_prediction_score()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create(['is_current' => true]);

        /** @var MlModelPrediction $prediction */
        $prediction = factory(MlModelPrediction::class)->create();

        /** @var MlModelPredictionData $predictionData */
        $predictionData = factory(MlModelPredictionData::class)->create();

        /** @var MlModelPredictionScore $predictionScore */
        $predictionScore = factory(MlModelPredictionScore::class)->create();

        $model->setProject($project);
        $state->setModel($model);
        $prediction->setModel($model);
        $predictionData->setPrediction($prediction);
        $predictionScore->setPrediction($prediction);

        // When
        $response = $this->delete(route('api.score.prediction.delete', ['id' => $prediction->id]), [], $this->getAuthHeader($user));
        $scores = MlModelPredictionScore::all();

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $this->assertEquals($scores->count(),0);
    }

    /** @test */
    public function non_project_user_should_not_delete_prediction_score()
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
        $state = factory(MlModelState::class)->create(['is_current' => true]);

        /** @var MlModelPrediction $prediction */
        $prediction = factory(MlModelPrediction::class)->create();

        /** @var MlModelPredictionData $predictionData */
        $predictionData = factory(MlModelPredictionData::class)->create();

        /** @var MlModelPredictionScore $predictionScore */
        $predictionScore = factory(MlModelPredictionScore::class)->create();

        $model->setProject($project);
        $state->setModel($model);
        $prediction->setModel($model);
        $predictionData->setPrediction($prediction);
        $predictionScore->setPrediction($prediction);

        // When
        $response = $this->delete(route('api.score.prediction.delete', ['id' => $prediction->id]), [], $this->getAuthHeader($member));
        $scores = MlModelPredictionScore::all();

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
        $this->assertEquals($scores->count(),1);
    }
}
