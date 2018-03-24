<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Role;
use App\Models\Team;
use App\User;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTeamTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function should_add_team_to_project()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        $team = factory(Team::class)->create();
        $project = factory(Project::class)->create();

        $data = [
            'project_id' => $project->id,
            'team_id'    => $team->id,
        ];

        // When
        $response = $this->postJson(route('project.addTeam'), $data, $this->getAuthHeader($user));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $this->assertDatabaseHas('project_team',
            [
                'team_id'    => $team->id,
                'project_id' => $project->id,
            ]
        );
    }

    /** @test */
    public function non_team_owner_should_not_add_team_to_project()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $roleTeam = Role::where('alias', Team::TEAM_DEFAULT_ROLE_ALIAS)->first();
        $roleProject = Role::where('alias', Project::PROJECT_OWNER_ROLE_ALIAS)->first();
        $this->be($user);

        $team = factory(Team::class)->create();
        $team->users()->attach($member, [
            'is_owner' => 0,
            'role_id'  => $roleTeam->id
        ]);

        $project = factory(Project::class)->create();
        $project->users()->attach($member, [
            'is_owner' => 1,
            'role_id'  => $roleProject->id
        ]);

        $data = [
            'project_id' => $project->id,
            'team_id'    => $team->id,
        ];

        // When
        $response = $this->postJson(route('project.addTeam'), $data, $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
        $this->assertDatabaseMissing('project_team',
            [
                'team_id'    => $team->id,
                'project_id' => $project->id,
            ]
        );
    }

    /** @test */
    public function non_team_member_should_not_add_team_to_project()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $roleProject = Role::where('alias', Project::PROJECT_OWNER_ROLE_ALIAS)->first();
        $this->be($user);

        $team = factory(Team::class)->create();
        $project = factory(Project::class)->create();
        $project->users()->attach($member, [
            'is_owner' => 1,
            'role_id'  => $roleProject->id
        ]);

        $data = [
            'project_id' => $project->id,
            'team_id'    => $team->id,
        ];

        // When
        $response = $this->postJson(route('project.addTeam'), $data, $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
        $this->assertDatabaseMissing('project_team',
            [
                'team_id'    => $team->id,
                'project_id' => $project->id,
            ]
        );
    }

    /** @test */
    public function non_project_owner_should_not_add_team_to_project()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $roleTeam = Role::where('alias', Team::TEAM_OWNER_ROLE_ALIAS)->first();
        $roleProject = Role::where('alias', Project::PROJECT_OWNER_ROLE_ALIAS)->first();
        $this->be($user);

        $team = factory(Team::class)->create();
        $team->users()->attach($member, [
            'is_owner' => 1,
            'role_id'  => $roleTeam->id
        ]);
        $project = factory(Project::class)->create();
        $project->users()->attach($member, [
            'is_owner' => 0,
            'role_id'  => $roleProject->id
        ]);

        $data = [
            'project_id' => $project->id,
            'team_id'    => $team->id,
        ];

        // When
        $response = $this->postJson(route('project.addTeam'), $data, $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
        $this->assertDatabaseMissing('project_team',
            [
                'team_id'    => $team->id,
                'project_id' => $project->id,
            ]
        );
    }

    /** @test */
    public function non_project_member_should_not_add_team_to_project()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $roleTeam = Role::where('alias', Team::TEAM_OWNER_ROLE_ALIAS)->first();
        $this->be($user);

        $team = factory(Team::class)->create();
        $team->users()->attach($member, [
            'is_owner' => 1,
            'role_id'  => $roleTeam->id
        ]);
        $project = factory(Project::class)->create();

        $data = [
            'project_id' => $project->id,
            'team_id'    => $team->id,
        ];

        // When
        $response = $this->postJson(route('project.addTeam'), $data, $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
        $this->assertDatabaseMissing('project_team',
            [
                'team_id'    => $team->id,
                'project_id' => $project->id,
            ]
        );
    }

    /** @test */
    public function should_remove_team_to_project()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        $team = factory(Team::class)->create();
        $project = factory(Project::class)->create();

        $data = [
            'project_id' => $project->id,
            'team_id'    => $team->id,
        ];

        // When
        $response = $this->postJson(route('project.deleteTeam'), $data, $this->getAuthHeader($user));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $this->assertDatabaseMissing('project_team',
            [
                'team_id'    => $team->id,
                'project_id' => $project->id,
            ]
        );
    }

    /** @test */
    public function non_team_owner_should_not_remove_team_from_project()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $roleTeam = Role::where('alias', Team::TEAM_DEFAULT_ROLE_ALIAS)->first();
        $roleProject = Role::where('alias', Project::PROJECT_OWNER_ROLE_ALIAS)->first();
        $this->be($user);

        $team = factory(Team::class)->create();
        $team->users()->attach($member, [
            'is_owner' => 0,
            'role_id'  => $roleTeam->id
        ]);

        $project = factory(Project::class)->create();
        $project->users()->attach($member, [
            'is_owner' => 1,
            'role_id'  => $roleProject->id
        ]);

        $project->teams()->attach($team);

        $data = [
            'project_id' => $project->id,
            'team_id'    => $team->id,
        ];

        // When
        $response = $this->postJson(route('project.deleteTeam'), $data, $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
        $this->assertDatabaseHas('project_team',
            [
                'team_id'    => $team->id,
                'project_id' => $project->id,
            ]
        );
    }

    /** @test */
    public function non_team_member_should_not_remove_team_from_project()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $roleProject = Role::where('alias', Project::PROJECT_OWNER_ROLE_ALIAS)->first();
        $this->be($user);

        $team = factory(Team::class)->create();

        $project = factory(Project::class)->create();
        $project->users()->attach($member, [
            'is_owner' => 1,
            'role_id'  => $roleProject->id
        ]);

        $project->teams()->attach($team);

        $data = [
            'project_id' => $project->id,
            'team_id'    => $team->id,
        ];

        // When
        $response = $this->postJson(route('project.deleteTeam'), $data, $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
        $this->assertDatabaseHas('project_team',
            [
                'team_id'    => $team->id,
                'project_id' => $project->id,
            ]
        );
    }

    /** @test */
    public function non_project_owner_should_not_remove_team_from_project()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $roleTeam = Role::where('alias', Team::TEAM_DEFAULT_ROLE_ALIAS)->first();
        $roleProject = Role::where('alias', Project::PROJECT_OWNER_ROLE_ALIAS)->first();
        $this->be($user);

        $team = factory(Team::class)->create();
        $team->users()->attach($member, [
            'is_owner' => 1,
            'role_id'  => $roleTeam->id
        ]);

        $project = factory(Project::class)->create();
        $project->users()->attach($member, [
            'is_owner' => 0,
            'role_id'  => $roleProject->id
        ]);

        $project->teams()->attach($team);

        $data = [
            'project_id' => $project->id,
            'team_id'    => $team->id,
        ];

        // When
        $response = $this->postJson(route('project.deleteTeam'), $data, $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
        $this->assertDatabaseHas('project_team',
            [
                'team_id'    => $team->id,
                'project_id' => $project->id,
            ]
        );
    }

    /** @test */
    public function non_project_member_should_not_remove_team_from_project()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $roleTeam = Role::where('alias', Team::TEAM_DEFAULT_ROLE_ALIAS)->first();
        $this->be($user);

        $team = factory(Team::class)->create();
        $team->users()->attach($member, [
            'is_owner' => 0,
            'role_id'  => $roleTeam->id
        ]);

        $project = factory(Project::class)->create();

        $project->teams()->attach($team);

        $data = [
            'project_id' => $project->id,
            'team_id'    => $team->id,
        ];

        // When
        $response = $this->postJson(route('project.deleteTeam'), $data, $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
        $this->assertDatabaseHas('project_team',
            [
                'team_id'    => $team->id,
                'project_id' => $project->id,
            ]
        );
    }
}
