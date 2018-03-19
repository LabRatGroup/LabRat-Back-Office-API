<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\Team;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class TeamUserControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function should_add_new_user_to_team()
    {
        // Given
        $owner = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Team::TEAM_DEFAULT_ROLE_ALIAS)->first();
        $this->be($owner);

        $team = factory(Team::class)->create();

        $data = [
            'user_id'  => $member->id,
            'team_id'  => $team->id,
            'is_owner' => 0,
        ];

        // When
        $response = $this->postJson(route('team.addMember'), $data, $this->getAuthHeader($owner));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);

        $this->assertDatabaseHas('team_users',
            [
                'user_id'  => $member->id,
                'team_id'  => $team->id,
                'is_owner' => 0,
                'role_id'  => $role->id,
            ]
        );
    }

    /** @test */
    public function should_add_user_to_team_as_owner()
    {
        // Given
        $owner = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Team::TEAM_DEFAULT_ROLE_ALIAS)->first();
        $this->be($owner);

        $team = factory(Team::class)->create();

        $data = [
            'user_id'  => $member->id,
            'team_id'  => $team->id,
            'is_owner' => 1,
        ];

        // When
        $response = $this->postJson(route('team.addMember'), $data, $this->getAuthHeader($owner));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);

        $this->assertDatabaseHas('team_users',
            [
                'user_id'  => $member->id,
                'team_id'  => $team->id,
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
        $role = Role::where('alias', Team::TEAM_DEFAULT_ROLE_ALIAS)->first();
        $this->be($owner);

        $team = factory(Team::class)->create();
        $team->users()->attach($member);

        $data = [
            'user_id'  => $user->id,
            'team_id'  => $team->id,
            'is_owner' => 1,
        ];

        // When
        $this->be($member);
        $response = $this->postJson(route('team.addMember'), $data, $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
        $this->assertDatabaseHas('team_users',
            [
                'user_id'  => $member->id,
                'team_id'  => $team->id,
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
        $role = Role::where('alias', Team::TEAM_DEFAULT_ROLE_ALIAS)->first();
        $this->be($owner);

        $team = factory(Team::class)->create();
        $team->users()->attach($member);

        $data = [
            'user_id'  => $member->id,
            'team_id'  => $team->id,
            'is_owner' => 0,
        ];

        // When
        $response = $this->postJson(route('team.addMember'), $data, $this->getAuthHeader($owner));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);

        $this->assertDatabaseHas('team_users',
            [
                'user_id'  => $member->id,
                'team_id'  => $team->id,
                'is_owner' => 0,
                'role_id'  => $role->id,
            ]
        );
    }
}
