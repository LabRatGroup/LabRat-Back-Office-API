<?php

namespace Tests\Feature;

use App\Models\MlModel;
use App\Models\Project;
use App\Models\Role;
use App\Models\Team;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class MlModelControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function project_user_should_display_model()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        $model->setProject($project);

        // When
        $response = $this->get(route('model.show', ['id' => $model->id]), $this->getAuthHeader($user));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['id' => $model->id]);
    }

    /** @test */
    public function project_team_member_should_display_model()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Team::TEAM_DEFAULT_ROLE_ALIAS)->first();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        $model->setProject($project);

        /** @var Team $team */
        $team = factory(Team::class)->create();
        $team->users()->attach($member, ['role_id' => $role->id]);

        $project->teams()->attach($team);

        // When
        $response = $this->get(route('model.show', ['id' => $model->id]), $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['id' => $model->id]);
    }

    /** @test */
    public function non_project_user_should_not_display_model()
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

        // When
        $response = $this->get(route('model.show', ['id' => $model->id]), $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
    }

    /** @test */
    public function should_create_model()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        $modelTitle = 'MODEL_TITLE';
        $project = factory(Project::class)->create();

        $data = [
            'title'      => $modelTitle,
            'project_id' => $project->id,
        ];

        // When
        $response = $this->postJson(route('model.create'), $data, $this->getAuthHeader($user));

        // Then
        $response->assertStatus(HttpResponse::HTTP_CREATED);
        $response->assertJsonFragment(['title' => $modelTitle]);
        $this->assertDatabaseHas('ml_models',
            [
                'title'      => $modelTitle,
                'project_id' => $project->id,
            ]
        );
    }

    /** @test */
    public function non_project_owner_should_not_create_model()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $this->be($user);

        $modelTitle = 'MODEL_TITLE';
        $project = factory(Project::class)->create();

        $data = [
            'title'      => $modelTitle,
            'project_id' => $project->id,
        ];

        // When
        $response = $this->postJson(route('model.create'), $data, $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
        $this->assertDatabaseMissing('ml_models',
            [
                'title'      => $modelTitle,
                'project_id' => $project->id,
            ]
        );
    }

    /** @test */
    public function should_update_model()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        $project1 = factory(Project::class)->create();
        $project2 = factory(Project::class)->create();
        $model = factory(MlModel::class)->create(['project_id' => $project1->id]);

        $data = [
            'project_id' => $project2->id,
        ];

        // When
        $response = $this->postJson(route('model.update', ['id' => $model->id]), $data, $this->getAuthHeader($user));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['project_id' => $project2->id]);
        $this->assertDatabaseHas('ml_models',
            [
                'id'         => $model->id,
                'project_id' => $project2->id,
            ]
        );
    }

    /** @test */
    public function non_project_owner_should_not_update_model()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $this->be($user);

        $project1 = factory(Project::class)->create();
        $project2 = factory(Project::class)->create();
        $model = factory(MlModel::class)->create(['project_id' => $project1->id]);

        $data = [
            'project_id' => $project2->id,
        ];

        // When
        $response = $this->postJson(route('model.update', ['id' => $model->id]), $data, $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
        $this->assertDatabaseHas('ml_models',
            [
                'id'         => $model->id,
                'project_id' => $project1->id,
            ]
        );
    }

    /** @test */
    public function should_delete_model()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        $project = factory(Project::class)->create();
        $model = factory(MlModel::class)->create(['project_id' => $project->id]);

        // When
        $response = $this->deleteJson(route('model.delete', ['id' => $model->id]), [], $this->getAuthHeader($user));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $this->assertSoftDeleted('ml_models',
            [
                'id'         => $model->id,
                'project_id' => $project->id,
            ]
        );
    }

    /** @test */
    public function non_project_owner_should_not_delete_model()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();

        $this->be($user);

        $project = factory(Project::class)->create();
        $model = factory(MlModel::class)->create(['project_id' => $project->id]);

        // When
        $response = $this->deleteJson(route('model.delete', ['id' => $model->id]), [], $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
        $this->assertDatabaseHas('ml_models',
            [
                'id'         => $model->id,
                'project_id' => $project->id,
                'deleted_at' => null,
            ]
        );
    }
}
