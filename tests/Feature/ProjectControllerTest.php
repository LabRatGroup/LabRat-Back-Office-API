<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Role;
use App\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase;

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
            'id'    => $project->id,
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
            'id'    => $project->id,
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
}
