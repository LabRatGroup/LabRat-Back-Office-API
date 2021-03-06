<?php

namespace Tests\Feature;

use App\Models\MlModel;
use App\Models\Project;
use App\Models\Role;
use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Tests\ApiTestCase;

class MlModelControllerTest extends ApiTestCase
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
        $response = $this->actingAs($user)->get(route('api.model.show', ['id' => $model->id]));

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
        $response = $this->actingAs($member)->get(route('api.model.show', ['id' => $model->id]));

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
        $response = $this->actingAs($member)->get(route('api.model.show', ['id' => $model->id]));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
    }

    /** @test */
    public function project_user_should_list_models()
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
        $response = $this->actingAs($user)->get(route('api.model.index', ['id' => $project->id]));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['id' => $model->id]);
    }

    /** @test */
    public function project_team_member_should_list_models()
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
        $response = $this->actingAs($member)->get(route('api.model.index', ['id' => $project->id]));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['id' => $model->id]);
    }

    /** @test */
    public function non_project_user_should_not_list_models()
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
        $response = $this->actingAs($member)->get(route('api.model.index', ['id' => $project->id]));

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
        $modelPositiveField = "MODEL_POSITIVE";
        $project = factory(Project::class)->create();

        $data = [
            'title'      => $modelTitle,
            'project_id' => $project->id,
            'positive'   => $modelPositiveField,
        ];

        // When
        $response = $this->actingAs($user)->postJson(route('api.model.create'), $data);

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
        $modelPositiveField = "MODEL_POSITIVE";
        $modelPositiveField = "MODEL_POSITIVE";
        $project = factory(Project::class)->create();

        $data = [
            'title'      => $modelTitle,
            'project_id' => $project->id,
            'positive'    => $modelPositiveField,
        ];

        // When
        $response = $this->actingAs($member)->postJson(route('api.model.create'), $data);

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
        $this->assertDatabaseMissing('ml_models',
            [
                'title'      => $modelTitle,
                'project_id' => $project->id,
                'positive'   => $modelPositiveField,
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
        $response = $this->actingAs($user)->postJson(route('api.model.update', ['id' => $model->id]), $data);

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
        $response = $this->actingAs($member)->postJson(route('api.model.update', ['id' => $model->id]), $data);

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
        $response = $this->actingAs($user)->deleteJson(route('api.model.delete', ['id' => $model->id]), []);

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
        $response = $this->actingAs($member)->deleteJson(route('api.model.delete', ['id' => $model->id]), []);

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
