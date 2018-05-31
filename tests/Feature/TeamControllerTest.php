<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Tests\ApiTestCase;

class TeamControllerTest extends ApiTestCase
{
    use RefreshDatabase;

    /** @test */
    public function should_access_team_details()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        $team = factory(Team::class)->create();

        // When
        $response = $this->actingAs($user)->get(route('api.team.show', ['id' => $team->id]));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['id' => $team->id]);
        $this->assertDatabaseHas('teams', ['id' => $team->id]);
    }

    /** @test */
    public function non_member_should_not_access_team_details()
    {
        // Given
        $user = factory(User::class)->create();
        $otherUser = factory(User::class)->create();
        $this->be($user);

        $team = factory(Team::class)->create();

        // When
        $this->be($otherUser);
        $response = $this->actingAs($otherUser)->get(route('api.team.show', ['id' => $team->id]));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
        $this->assertDatabaseHas('teams', ['id' => $team->id]);
    }

    /** @test */
    public function should_access_team_list()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        $team1 = factory(Team::class)->create();
        $team2 = factory(Team::class)->create();

        // When
        $response = $this->actingAs($user)->get(route('api.team.index'));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['id' => $team1->id]);
        $response->assertJsonFragment(['id' => $team2->id]);
    }

    /** @test */
    public function non_member_should_not_access_team_list()
    {
        // Given
        $user1 = factory(User::class)->create();
        $this->be($user1);
        $team1 = factory(Team::class)->create();

        $user2 = factory(User::class)->create();
        $this->be($user2);
        $team2 = factory(Team::class)->create();

        // When
        $response = $this->actingAs($user1)->get(route('api.team.index'));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['id' => $team1->id]);
        $response->assertJsonMissing(['id' => $team2->id]);
    }

    /** @test */
    public function should_register_team()
    {
        // Given
        $user = factory(User::class)->create();
        $role = Role::where('alias', Team::TEAM_OWNER_ROLE_ALIAS)->first();

        $name = 'TEAM_NAME';
        $data = ['name' => $name];

        // When
        $response = $this->actingAs($user)->postJson(route('api.team.create'), $data);
        $team = DB::table('teams')->where('name', $name)->first();

        // Then
        $response->assertStatus(HttpResponse::HTTP_CREATED);
        $response->assertJsonStructure(['data' => ['name']]);

        $this->assertDatabaseHas('teams', ['name' => $name]);
        $this->assertDatabaseHas('team_user', [
            'user_id'  => $user->id,
            'team_id'  => $team->id,
            'is_owner' => 1,
            'role_id'  => $role->id,
        ]);
    }

    /** @test */
    public function should_update_team()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);
        
        $teamName1 = 'TEAM_NAME_1';
        $team = factory(Team::class)->create(['name' => $teamName1]);

        $teamName2 = 'TEAM_NAME_2';

        $data = [
            'name' => $teamName2,
        ];

        // When
        $response = $this->actingAs($user)->postJson(route('api.team.update', ['id' => $team->id]), $data);

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonStructure(['data' => ['name']]);

        $this->assertDatabaseMissing('teams', ['name' => $teamName1]);
        $this->assertDatabaseHas('teams', ['name' => $teamName2]);
        $this->assertDatabaseHas('team_user', [
            'user_id'  => $user->id,
            'team_id'  => $team->id,
            'is_owner' => 1,
        ]);
    }

    /** @test */
    public function should_not_update_team()
    {
        // Given
        $user = factory(User::class)->create();
        $otherUser = factory(User::class)->create();
        $this->be($user);

        $teamName1 = 'TEAM_NAME_1';
        $team = factory(Team::class)->create(['name' => $teamName1]);

        $teamName2 = 'TEAM_NAME_2';

        $data = [
            'name' => $teamName2,
        ];

        // When
        $this->be($otherUser);
        $response = $this->actingAs($otherUser)->postJson(route('api.team.update', ['id' => $team->id]), $data);

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);

        $this->assertDatabaseHas('teams', ['name' => $teamName1]);
        $this->assertDatabaseMissing('teams', ['name' => $teamName2]);
        $this->assertDatabaseHas('team_user', [
            'user_id'  => $user->id,
            'team_id'  => $team->id,
            'is_owner' => 1,
        ]);
    }

    /** @test */
    public function should_remove_team()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        $team = factory(Team::class)->create();

        // When
        $response = $this->actingAs($user)->delete(route('api.team.delete', ['id' => $team->id]), []);

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);

        $this->assertDatabaseMissing('teams', ['id' => $team->id]);
        $this->assertDatabaseMissing('team_user', [
            'user_id'  => $user->id,
            'team_id'  => $team->id,
            'is_owner' => 1,
        ]);
    }

    /** @test */
    public function should_not_delete_team()
    {
        // Given
        $user = factory(User::class)->create();
        $otherUser = factory(User::class)->create();
        $this->be($user);

        $team = factory(Team::class)->create();

        // When
        $this->be($otherUser);
        $response = $this->actingAs($otherUser)->delete(route('api.team.delete', ['id' => $team->id]), []);

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);

        $this->assertDatabaseHas('teams', ['id' => $team->id]);
        $this->assertDatabaseHas('team_user', [
            'user_id'  => $user->id,
            'team_id'  => $team->id,
            'is_owner' => 1,
        ]);
    }
}
