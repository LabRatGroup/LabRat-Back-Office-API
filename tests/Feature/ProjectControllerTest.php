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
            'user_id' => $user->id,
            'project_id' => $team->id,
            'is_owner' => 1,
            'role_id' => $role->id,
        ]);
    }
}
