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
        $header = $this->getAuthHeader($user);
        $response = $this->get(route('project.show', ['id' => $project->id]), $header);

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
        $header = $this->getAuthHeader($member);
        $response = $this->get(route('project.show', ['id' => $project->id]), $header);

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
        $header = $this->getAuthHeader($otherUser);
        $response = $this->get(route('project.show', ['id' => $project->id]), $header);

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
        $header = $this->getAuthHeader($user);
        $response = $this->get(route('project.index'), $header);

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
        $header = $this->getAuthHeader($member);
        $response = $this->get(route('project.index'), $header);

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
        $header = $this->getAuthHeader($user1);
        $response = $this->get(route('project.index'), $header);

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
        $response = $this->postJson(route('project.create'), $data, $this->getAuthHeader($user));
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
        $header = $this->getAuthHeader($user);

        $title1 = 'PROJECT_TITLE_1';
        $project = factory(Project::class)->create(['title' => $title1]);

        $title2 = 'PROJECT_TITLE_2';

        $data = [
            'title' => $title2,
        ];

        // When
        $response = $this->postJson(route('project.update', ['id' => $project->id]), $data, $header);

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
        $header = $this->getAuthHeader($otherUser);
        $response = $this->postJson(route('project.update', ['id' => $project->id]), $data, $header);

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
        $header = $this->getAuthHeader($user);

        $project = factory(Project::class)->create();

        // When
        $response = $this->delete(route('project.delete', ['id' => $project->id]), [], $header);

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
        $header = $this->getAuthHeader($otherUser);
        $response = $this->delete(route('project.delete', ['id' => $project->id]), [], $header);

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
