<?php

namespace Tests\Feature;

use App\Models\MlAlgorithm;
use App\Models\MlModel;
use App\Models\MlModelState;
use App\Models\MlModelStateScore;
use App\Models\Project;
use App\Models\Role;
use App\Models\Team;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class MlModelStateScoreControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function project_user_should_display_state_score()
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
        $model->setProject($project);

        /** @var MlAlgorithm $algorithm */
        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create();
        $state->setAlgorithm($algorithm);
        $state->setModel($model);

        /** @var MlModelStateScore $score */
        $score = factory(MlModelStateScore::class)->create();
        $score->setState($state);

        // When
        $response = $this->actingAs($member)->get(route('api.score.show', ['id' => $state->id]));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['kappa']);

    }

    /** @test */
    public function project_team_member_should_display_state_score()
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
        $model->setProject($project);

        /** @var MlAlgorithm $algorithm */
        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create();
        $state->setAlgorithm($algorithm);
        $state->setModel($model);

        /** @var MlModelStateScore $score */
        $score = factory(MlModelStateScore::class)->create();
        $score->setState($state);

        // When
        $response = $this->actingAs($member)->get(route('api.score.show', ['id' => $state->id]));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['kappa']);
    }

    /** @test */
    public function non_project_user_should_not_display_state_score()
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
        $state = factory(MlModelState::class)->create();
        $state->setAlgorithm($algorithm);
        $state->setModel($model);

        /** @var MlModelStateScore $score */
        $score = factory(MlModelStateScore::class)->create();
        $score->setState($state);

        // When
        $response = $this->actingAs($member)->get(route('api.score.show', ['id' => $state->id]));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
    }
}
