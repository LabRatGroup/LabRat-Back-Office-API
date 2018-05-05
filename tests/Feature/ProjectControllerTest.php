<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Role;
use App\Models\Team;
use App\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_should_access_project_details()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        $project = factory(Project::class)->create();

        // When
        $response = $this->actingAs($user)->get(route('api.project.show', ['id' => $project->id]));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['id' => $project->id]);
        $this->assertDatabaseHas('projects', ['id' => $project->id]);
    }

    /** @test */
    public function team_member_should_access_project_details()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Team::TEAM_DEFAULT_ROLE_ALIAS)->first();
        $this->be($user);

        $project = factory(Project::class)->create();
        $team = factory(Team::class)->create();
        $team->users()->attach($member, [
            'is_owner' => 0,
            'role_id'  => $role->id,
        ]);
        $project->teams()->attach($team);

        // When
        $response = $this->actingAs($member)->get(route('api.project.show', ['id' => $project->id]));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['id' => $project->id]);
        $this->assertDatabaseHas('projects', ['id' => $project->id]);
    }

    /** @test */
    public function non_associate_should_not_access_project_details()
    {
        // Given
        $user = factory(User::class)->create();
        $otherUser = factory(User::class)->create();
        $this->be($user);

        $project = factory(Project::class)->create();

        // When
        $this->be($otherUser);
        $response = $this->actingAs($otherUser)->get(route('api.project.show', ['id' => $project->id]));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
        $this->assertDatabaseHas('projects', ['id' => $project->id]);
    }

    /** @test */
    public function user_should_access_project_list()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        $project1 = factory(Project::class)->create();
        $project2 = factory(Project::class)->create();

        // When
        $response = $this->actingAs($user)->get(route('api.project.index'));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['id' => $project1->id]);
        $response->assertJsonFragment(['id' => $project2->id]);
    }

    /** @test */
    public function team_member_should_access_project_list()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Team::TEAM_DEFAULT_ROLE_ALIAS)->first();
        $this->be($user);

        $team = factory(Team::class)->create();
        $team->users()->attach($member,
            [
                'is_owner' => 0,
                'role_id'  => $role->id,
            ]);

        $project1 = factory(Project::class)->create();
        $project1->teams()->attach($team);

        $project2 = factory(Project::class)->create();

        // When
        $response = $this->actingAs($member)->get(route('api.project.index'));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['id' => $project1->id]);
        $response->assertJsonMissing(['id' => $project2->id]);
    }

    /** @test */
    public function non_associate_should_not_access_project_list()
    {
        // Given
        $user1 = factory(User::class)->create();
        $this->be($user1);
        $project1 = factory(Project::class)->create();

        $user2 = factory(User::class)->create();
        $this->be($user2);
        $project2 = factory(Project::class)->create();


        // When
        $response = $this->actingAs($user1)->get(route('api.project.index'));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['id' => $project1->id]);
        $response->assertJsonMissing(['id' => $project2->id]);;
    }

    /** @test */
    public function should_create_project()
    {
        // Given
        $user = factory(User::class)->create();
        $role = Role::where('alias', Project::PROJECT_OWNER_ROLE_ALIAS)->first();

        $title = 'PROJECT_TITLE';
        $data = ['title' => $title];

        // When
        $response = $this->actingAs($user)->postJson(route('api.project.create'), $data);
        $team = DB::table('projects')->where('title', $title)->first();

        // Then
        $response->assertStatus(HttpResponse::HTTP_CREATED);
        $response->assertJsonStructure(['data' => ['title']]);

        $this->assertDatabaseHas('projects', ['title' => $title]);
        $this->assertDatabaseHas('project_user', [
            'user_id'    => $user->id,
            'project_id' => $team->id,
            'is_owner'   => 1,
            'role_id'    => $role->id,
        ]);
    }

    /** @test */
    public function should_update_project()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        $title1 = 'PROJECT_TITLE_1';
        $project = factory(Project::class)->create(['title' => $title1]);

        $title2 = 'PROJECT_TITLE_2';

        $data = [
            'title' => $title2,
        ];

        // When
        $response = $this->actingAs($user)->postJson(route('api.project.update', ['id' => $project->id]), $data);

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonStructure(['data' => ['title']]);

        $this->assertDatabaseMissing('projects', ['title' => $title1]);
        $this->assertDatabaseHas('projects', ['title' => $title2]);
        $this->assertDatabaseHas('project_user', [
            'user_id'    => $user->id,
            'project_id' => $project->id,
            'is_owner'   => 1,
        ]);
    }

    /** @test */
    public function should_not_update_project()
    {
        // Given
        $user = factory(User::class)->create();
        $otherUser = factory(User::class)->create();
        $this->be($user);

        $title1 = 'PROJECT_TITLE_1';
        $project = factory(Project::class)->create(['title' => $title1]);

        $title2 = 'PROJECT_TITLE_2';

        $data = [
            'title' => $title1,
        ];

        // When
        $this->be($otherUser);
        $response = $this->actingAs($otherUser)->postJson(route('api.project.update', ['id' => $project->id]), $data);

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);

        $this->assertDatabaseHas('projects', ['title' => $title1]);
        $this->assertDatabaseMissing('projects', ['title' => $title2]);
        $this->assertDatabaseHas('project_user', [
            'user_id'    => $user->id,
            'project_id' => $project->id,
            'is_owner'   => 1,
        ]);
    }

    /** @test */
    public function should_remove_project()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        $project = factory(Project::class)->create();

        // When
        $response = $this->actingAs($user)->delete(route('api.project.delete', ['id' => $project->id]), []);

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);

        $this->assertSoftDeleted('projects', ['id' => $project->id]);
        $this->assertDatabaseMissing('project_user', [
            'user_id'    => $user->id,
            'project_id' => $project->id,
            'is_owner'   => 1,
        ]);
    }

    /** @test */
    public function should_not_delete_project()
    {
        // Given
        $user = factory(User::class)->create();
        $otherUser = factory(User::class)->create();
        $this->be($user);

        $project = factory(Project::class)->create();

        // When
        $this->be($otherUser);
        $response = $this->actingAs($otherUser)->delete(route('api.project.delete', ['id' => $project->id]), []);

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);

        $this->assertDatabaseHas('projects', [
            'id'         => $project->id,
            'deleted_at' => null,
        ]);
        $this->assertDatabaseHas('project_user', [
            'user_id'    => $user->id,
            'project_id' => $project->id,
            'is_owner'   => 1,
        ]);
    }
}
