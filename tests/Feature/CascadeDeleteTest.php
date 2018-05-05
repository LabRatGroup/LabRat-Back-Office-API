<?php

namespace Tests\Feature;

use App\Models\MlModel;
use App\Models\MlModelState;
use App\Models\Project;
use App\Models\Role;
use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Tests\ApiTestCase;

class CascadeDeleteTest extends ApiTestCase
{
    use RefreshDatabase;

    /** @test */
    public function should_soft_delete_model_state_and_model_when_deleting_project()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        /** @var Team $team1 */
        $team = factory(Team::class)->create();

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create();

        $team->projects()->attach($project);
        $model->setProject($project);
        $state->setModel($model);

        // When
        $response = $this->actingAs($user)->deleteJson(route('api.project.delete', ['id' => $project->id]), []);

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);

        $this->assertSoftDeleted('projects', [
            'id' => $project->id,
        ]);
        $this->assertSoftDeleted('ml_models', [
            'id' => $model->id,
        ]);
        $this->assertSoftDeleted('ml_model_states', [
            'id' => $state->id,
        ]);
        $this->assertDatabaseMissing('project_user', [
            'project_id' => $project->id,
            'user_id'    => $user->id,
        ]);
        $this->assertDatabaseMissing('project_team', [
            'project_id' => $project->id,
            'team_id'    => $team->id,
        ]);
    }

    /** @test */
    public function should_remove_project_and_user_relations_when_team_is_deleted()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $roleProject = Role::where('alias', Project::PROJECT_DEFAULT_ROLE_ALIAS)->first();
        $roleTeam = Role::where('alias', Team::TEAM_DEFAULT_ROLE_ALIAS)->first();
        $this->be($user);

        /** @var Team $team */
        $team = factory(Team::class)->create();

        /** @var Project $project */
        $project = factory(Project::class)->create();

        $project->users()->attach($member, ['role_id' => $roleProject->id]);
        $team->users()->attach($member, ['role_id' => $roleTeam->id]);
        $team->projects()->attach($project);


        // When
        $response = $this->actingAs($user)->deleteJson(route('api.team.delete', ['id' => $team->id]), []);

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);

        $this->assertDatabaseMissing('teams', [
            'id' => $team->id,
        ]);

        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
        ]);

        $this->assertDatabaseMissing('team_user', [
            'team_id'  => $team->id,
            'user_id'  => $member->id,
            'is_owner' => false,
        ]);

        $this->assertDatabaseMissing('team_user', [
            'team_id'  => $team->id,
            'user_id'  => $user->id,
            'is_owner' => true,
        ]);

        $this->assertDatabaseMissing('project_team', [
            'team_id'    => $team->id,
            'project_id' => $project->id,
        ]);
    }

    /** @test */
    public function should_remove_team_and_user_relations_when_project_is_deleted()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $roleProject = Role::where('alias', Project::PROJECT_DEFAULT_ROLE_ALIAS)->first();
        $roleTeam = Role::where('alias', Team::TEAM_DEFAULT_ROLE_ALIAS)->first();
        $this->be($user);

        /** @var Team $team1 */
        $team1 = factory(Team::class)->create();

        /** @var Team $team2 */
        $team2 = factory(Team::class)->create();

        /** @var Project $project */
        $project = factory(Project::class)->create();

        $project->users()->attach($member, ['role_id' => $roleProject->id]);
        $team1->users()->attach($member, ['role_id' => $roleTeam->id]);
        $team1->projects()->attach($project);
        $team2->projects()->attach($project);


        // When
        $response = $this->actingAs($user)->deleteJson(route('api.project.delete', ['id' => $project->id]), []);

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);

        $this->assertDatabaseHas('teams', [
            'id' => $team1->id,
        ]);

        $this->assertSoftDeleted('projects', [
            'id' => $project->id,
        ]);

        $this->assertDatabaseMissing('project_user', [
            'project_id' => $project->id,
            'user_id'    => $member->id,
            'is_owner'   => false,
        ]);

        $this->assertDatabaseMissing('project_user', [
            'project_id' => $project->id,
            'user_id'    => $user->id,
            'is_owner'   => true,
        ]);

        $this->assertDatabaseMissing('project_team', [
            'team_id'    => $team1->id,
            'project_id' => $project->id,
        ]);

        $this->assertDatabaseMissing('project_team', [
            'team_id'    => $team2->id,
            'project_id' => $project->id,
        ]);
    }

    public function should_remove_user_team_and_project_relations_when_not_unique_owner()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $roleProject = Role::where('alias', Project::PROJECT_OWNER_ROLE_ALIAS)->first();
        $roleTeam = Role::where('alias', Team::TEAM_OWNER_ROLE_ALIAS)->first();
        $this->be($user);

        /** @var Team $team1 */
        $team = factory(Team::class)->create();

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create();

        $team->users()->attach($member, [
            'role_id'  => $roleTeam->id,
            'is_owner' => true,
        ]);
        $project->users()->attach($member, [
            'role_id'  => $roleProject->id,
            'is_owner' => true,
        ]);
        $team->projects()->attach($project);
        $model->setProject($project);
        $state->setModel($model);


        // When
        $response = $this->actingAs($user)->postJson(route('api.user.un-register'), ['email' => $user->email]);

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
        $this->assertDatabaseMissing('team_user', [
            'team_id'  => $team->id,
            'user_id'  => $user->id,
            'is_owner' => true,
        ]);

        $this->assertDatabaseMissing('project_user', [
            'project_id' => $project->id,
            'user_id'    => $user->id,
            'is_owner'   => true,
        ]);
    }

    public function should_not_remove_user_team_and_project_relations_when_unique_owner()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $roleProject = Role::where('alias', Project::PROJECT_DEFAULT_ROLE_ALIAS)->first();
        $roleTeam = Role::where('alias', Team::TEAM_DEFAULT_ROLE_ALIAS)->first();
        $this->be($user);

        /** @var Team $team1 */
        $team = factory(Team::class)->create();

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create();

        $team->users()->attach($member, [
            'role_id'  => $roleTeam->id,
            'is_owner' => false,
        ]);
        $project->users()->attach($member, [
            'role_id'  => $roleProject->id,
            'is_owner' => false,
        ]);
        $team->projects()->attach($project);
        $model->setProject($project);
        $state->setModel($model);


        // When
        $response = $this->actingAs($user)->postJson(route('api.user.un-register'), ['email' => $user->email]);

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
        $this->assertDatabaseHas('users', ['id' => $user->id]);
        $this->assertDatabaseHas('team_user', [
            'team_id'  => $team->id,
            'user_id'  => $user->id,
            'is_owner' => true,
        ]);
        $this->assertDatabaseHas('project_user', [
            'project_id' => $project->id,
            'user_id'    => $user->id,
            'is_owner'   => true,
        ]);
    }
}
