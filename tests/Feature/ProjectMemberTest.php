<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Role;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class ProjectMemberTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function should_add_new_user_to_project()
    {
        // Given
        $owner = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Project::PROJECT_DEFAULT_ROLE_ALIAS)->first();
        $this->be($owner);

        $project = factory(Project::class)->create();

        $data = [
            'user_id'    => $member->id,
            'project_id' => $project->id,
            'is_owner'   => 0,
        ];

        // When
        $response = $this->postJson(route('project.addMember'), $data, $this->getAuthHeader($owner));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);

        $this->assertDatabaseHas('project_user',
            [
                'user_id'    => $member->id,
                'project_id' => $project->id,
                'is_owner'   => 0,
                'role_id'    => $role->id,
            ]
        );
    }

    /** @test */
    public function should_add_user_to_team_as_owner()
    {
        // Given
        $owner = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Project::PROJECT_DEFAULT_ROLE_ALIAS)->first();
        $this->be($owner);

        $project = factory(Project::class)->create();

        $data = [
            'user_id'  => $member->id,
            'project_id'  => $project->id,
            'is_owner' => 1,
        ];

        // When
        $response = $this->postJson(route('project.addMember'), $data, $this->getAuthHeader($owner));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);

        $this->assertDatabaseHas('project_user',
            [
                'user_id'  => $member->id,
                'project_id'  => $project->id,
                'is_owner' => 1,
                'role_id'  => $role->id,
            ]
        );
    }

    /** @test */
    public function non_owner_should_not_add_user_to_team()
    {
        // Given
        $owner = factory(User::class)->create();
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Project::PROJECT_DEFAULT_ROLE_ALIAS)->first();
        $this->be($owner);

        $project = factory(Project::class)->create();
        $project->users()->attach($member, [
            'is_owner' => 0,
            'role_id'  => $role->id
        ]);

        $data = [
            'user_id'  => $user->id,
            'project_id'  => $project->id,
            'is_owner' => 1,
        ];

        // When
        $this->be($member);
        $response = $this->postJson(route('project.addMember'), $data, $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
        $this->assertDatabaseHas('project_user',
            [
                'user_id'  => $member->id,
                'project_id'  => $project->id,
                'is_owner' => 0,
                'role_id'  => $role->id,
            ]
        );
    }

    /** @test */
    public function should_not_add_member_to_team()
    {
        // Given
        $owner = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Project::PROJECT_DEFAULT_ROLE_ALIAS)->first();
        $this->be($owner);

        $project = factory(Project::class)->create();
        $project->users()->attach($member, [
            'is_owner' => 0,
            'role_id'  => $role->id
        ]);

        $data = [
            'user_id'  => $member->id,
            'project_id'  => $project->id,
            'is_owner' => 0,
        ];

        // When
        $response = $this->postJson(route('project.addMember'), $data, $this->getAuthHeader($owner));

        // Then
        $response->assertStatus(HttpResponse::HTTP_INTERNAL_SERVER_ERROR);

        $this->assertDatabaseHas('project_user',
            [
                'user_id'  => $member->id,
                'project_id'  => $project->id,
                'is_owner' => 0,
                'role_id'  => $role->id,
            ]
        );
    }

    /** @test */
    public function should_add_member_as_owner()
    {
        // Given
        $owner = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Project::PROJECT_DEFAULT_ROLE_ALIAS)->first();
        $this->be($owner);

        $project = factory(Project::class)->create();
        $project->users()->attach($member, [
            'is_owner' => 0,
            'role_id'  => $role->id
        ]);

        $data = [
            'user_id'  => $member->id,
            'project_id'  => $project->id,
            'is_owner' => 1,
        ];

        // When
        $response = $this->postJson(route('project.updateMember'), $data, $this->getAuthHeader($owner));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);

        $this->assertDatabaseHas('project_user',
            [
                'user_id'  => $member->id,
                'project_id'  => $project->id,
                'is_owner' => 1,
                'role_id'  => $role->id,
            ]
        );
    }

    /** @test */
    public function non_owner_should_not_add_member_as_owner()
    {
        // Given
        $owner = factory(User::class)->create();
        $member = factory(User::class)->create();
        $user = factory(User::class)->create();
        $role = Role::where('alias', Project::PROJECT_DEFAULT_ROLE_ALIAS)->first();
        $this->be($owner);

        $project = factory(Project::class)->create();
        $project->users()->attach($member, [
            'is_owner' => 0,
            'role_id'  => $role->id
        ]);
        $project->users()->attach($user, [
            'is_owner' => 0,
            'role_id'  => $role->id
        ]);

        $data = [
            'user_id'  => $user->id,
            'project_id'  => $project->id,
            'is_owner' => 1,
        ];

        // When
        $this->be($member);
        $response = $this->postJson(route('project.updateMember'), $data, $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);

        $this->assertDatabaseHas('project_user',
            [
                'user_id'  => $user->id,
                'project_id'  => $project->id,
                'is_owner' => 0,
                'role_id'  => $role->id,
            ]
        );
    }

    /** @test */
    public function should_not_add_owner_as_owner()
    {
        // Given
        $owner = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Project::PROJECT_DEFAULT_ROLE_ALIAS)->first();
        $this->be($owner);

        $project = factory(Project::class)->create();
        $project->users()->attach($member, [
            'is_owner' => 1,
            'role_id'  => $role->id
        ]);

        $data = [
            'user_id'  => $member->id,
            'project_id'  => $project->id,
            'is_owner' => 1,
        ];

        // When
        $response = $this->postJson(route('project.updateMember'), $data, $this->getAuthHeader($owner));

        // Then
        $response->assertStatus(HttpResponse::HTTP_INTERNAL_SERVER_ERROR);

        $this->assertDatabaseHas('project_user',
            [
                'user_id'  => $member->id,
                'project_id'  => $project->id,
                'is_owner' => 1,
                'role_id'  => $role->id,
            ]
        );
    }

    /** @test */
    public function should_not_add_himself_as_owner()
    {
        // Given
        $owner = factory(User::class)->create();
        $this->be($owner);

        $project = factory(Project::class)->create();
        $data = [
            'user_id'  => $owner->id,
            'project_id'  => $project->id,
            'is_owner' => 1,
        ];

        // When
        $response = $this->postJson(route('project.updateMember'), $data, $this->getAuthHeader($owner));

        // Then
        $response->assertStatus(HttpResponse::HTTP_INTERNAL_SERVER_ERROR);

        $this->assertDatabaseHas('project_user',
            [
                'user_id'  => $owner->id,
                'project_id'  => $project->id,
                'is_owner' => 1,
            ]
        );
    }

    /** @test */
    public function should_remove_ownership_from_owner()
    {
        // Given
        $owner = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Project::PROJECT_DEFAULT_ROLE_ALIAS)->first();
        $this->be($owner);

        $project = factory(Project::class)->create();
        $project->users()->attach($member, [
            'is_owner' => 1,
            'role_id'  => $role->id
        ]);

        $data = [
            'user_id'  => $member->id,
            'project_id'  => $project->id,
            'is_owner' => 0,
        ];

        // When
        $response = $this->postJson(route('project.updateMember'), $data, $this->getAuthHeader($owner));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);

        $this->assertDatabaseHas('project_user',
            [
                'user_id'  => $member->id,
                'project_id'  => $project->id,
                'is_owner' => 0,
                'role_id'  => $role->id,
            ]
        );
    }

    /** @test */
    public function should_not_remove_ownership_from_member()
    {
        // Given
        $owner = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Project::PROJECT_DEFAULT_ROLE_ALIAS)->first();
        $this->be($owner);

        $project = factory(Project::class)->create();
        $project->users()->attach($member, [
            'is_owner' => 0,
            'role_id'  => $role->id
        ]);

        $data = [
            'user_id'  => $member->id,
            'project_id'  => $project->id,
            'is_owner' => 0,
        ];

        // When
        $response = $this->postJson(route('project.updateMember'), $data, $this->getAuthHeader($owner));

        // Then
        $response->assertStatus(HttpResponse::HTTP_INTERNAL_SERVER_ERROR);

        $this->assertDatabaseHas('project_user',
            [
                'user_id'  => $member->id,
                'project_id'  => $project->id,
                'is_owner' => 0,
                'role_id'  => $role->id,
            ]
        );
    }

    /** @test */
    public function non_owner_should_not_remove_ownership_from_owner()
    {
        // Given
        $owner = factory(User::class)->create();
        $member = factory(User::class)->create();
        $user = factory(User::class)->create();
        $role = Role::where('alias', Project::PROJECT_DEFAULT_ROLE_ALIAS)->first();
        $this->be($owner);

        $project = factory(Project::class)->create();
        $project->users()->attach($member, [
            'is_owner' => 0,
            'role_id'  => $role->id
        ]);
        $project->users()->attach($user, [
            'is_owner' => 1,
            'role_id'  => $role->id
        ]);

        $data = [
            'user_id'  => $user->id,
            'project_id'  => $project->id,
            'is_owner' => 0,
        ];

        // When
        $this->be($member);
        $response = $this->postJson(route('project.updateMember'), $data, $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);

        $this->assertDatabaseHas('project_user',
            [
                'user_id'  => $user->id,
                'project_id'  => $project->id,
                'is_owner' => 1,
                'role_id'  => $role->id,
            ]
        );
    }

    /** @test */
    public function owner_should_not_remove_ownership_from_himself()
    {
        // Given
        $owner = factory(User::class)->create();
        $role = Role::where('alias', Project::PROJECT_OWNER_ROLE_ALIAS)->first();
        $this->be($owner);

        $project = factory(Project::class)->create();


        $data = [
            'user_id'  => $owner->id,
            'project_id'  => $project->id,
            'is_owner' => 0,
        ];

        // When
        $response = $this->postJson(route('project.updateMember'), $data, $this->getAuthHeader($owner));

        // Then
        $response->assertStatus(HttpResponse::HTTP_INTERNAL_SERVER_ERROR);

        $this->assertDatabaseHas('project_user',
            [
                'user_id'  => $owner->id,
                'project_id'  => $project->id,
                'is_owner' => 1,
                'role_id'  => $role->id,
            ]
        );
    }

    /** @test */
    public function should_remove_member_from_project()
    {
        // Given
        $owner = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Project::PROJECT_DEFAULT_ROLE_ALIAS)->first();
        $this->be($owner);

        $project = factory(Project::class)->create();
        $project->users()->attach($member, [
            'is_owner' => 0,
            'role_id'  => $role->id
        ]);

        $data = [
            'user_id' => $member->id,
            'project_id' => $project->id,
        ];

        // When
        $response = $this->postJson(route('project.deleteMember'), $data, $this->getAuthHeader($owner));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);

        $this->assertDatabaseMissing('project_user',
            [
                'user_id'  => $member->id,
                'project_id'  => $project->id,
                'is_owner' => 0,
                'role_id'  => $role->id,
            ]
        );
    }

    /** @test */
    public function should_remove_itself_from_project()
    {
        // Given
        $owner = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Project::PROJECT_DEFAULT_ROLE_ALIAS)->first();
        $this->be($owner);

        $project = factory(Project::class)->create();
        $project->users()->attach($member, [
            'is_owner' => 0,
            'role_id'  => $role->id
        ]);

        $data = [
            'user_id' => $member->id,
            'project_id' => $project->id,
        ];

        // When
        $this->be($member);
        $response = $this->postJson(route('project.deleteMember'), $data, $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);

        $this->assertDatabaseMissing('project_user',
            [
                'user_id'  => $member->id,
                'project_id'  => $project->id,
                'is_owner' => 0,
                'role_id'  => $role->id,
            ]
        );
    }

    /** @test */
    public function should_remove_itself_from_project_as_owner()
    {
        // Given
        $owner = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Project::PROJECT_OWNER_ROLE_ALIAS)->first();
        $this->be($owner);

        $project = factory(Project::class)->create();
        $project->users()->attach($member, [
            'is_owner' => 1,
            'role_id'  => $role->id
        ]);

        $data = [
            'user_id' => $member->id,
            'project_id' => $project->id,
        ];

        // When
        $this->be($member);
        $response = $this->postJson(route('project.deleteMember'), $data, $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);

        $this->assertDatabaseMissing('project_user',
            [
                'user_id'  => $member->id,
                'project_id'  => $project->id,
                'is_owner' => 1,
                'role_id'  => $role->id,
            ]
        );
    }

    /** @test */
    public function non_owner_should_not_remove_member_from_project()
    {
        // Given
        $owner = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Project::PROJECT_DEFAULT_ROLE_ALIAS)->first();
        $this->be($owner);

        $project = factory(Project::class)->create();
        $project->users()->attach($member, [
            'is_owner' => 0,
            'role_id'  => $role->id
        ]);

        $data = [
            'user_id' => $owner->id,
            'project_id' => $project->id,
        ];

        // When
        $this->be($member);
        $response = $this->postJson(route('project.deleteMember'), $data, $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);

        $this->assertDatabaseHas('project_user',
            [
                'user_id'  => $owner->id,
                'project_id'  => $project->id,
                'is_owner' => 1,
            ]
        );
    }

    /** @test */
    public function only_owner_should_not_remove_itself_from_project()
    {
        // Given
        $owner = factory(User::class)->create();
        $this->be($owner);

        $project = factory(Project::class)->create();

        $data = [
            'user_id' => $owner->id,
            'project_id' => $project->id,
        ];

        // When
        $response = $this->postJson(route('project.deleteMember'), $data, $this->getAuthHeader($owner));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);

        $this->assertDatabaseHas('project_user',
            [
                'user_id'  => $owner->id,
                'project_id'  => $project->id,
                'is_owner' => 1,
            ]
        );
    }
}
