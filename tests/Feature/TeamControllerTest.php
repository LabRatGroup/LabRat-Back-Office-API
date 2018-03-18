<?php

namespace Tests\Feature;

use App\Models\Team;
use App\User;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeamControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function should_register_team()
    {
        // Given
        $user = factory(User::class)->create();

        $name = 'TEAM_NAME';
        $data = ['name' => $name];

        // When
        $response = $this->postJson(route('team.create'), $data, $this->getAuthHeader($user));
        $team = DB::table('teams')->where('name', $name)->first();

        // Then
        $response->assertStatus(HttpResponse::HTTP_CREATED);
        $response->assertJsonStructure(['data' => ['name']]);

        $this->assertDatabaseHas('teams', ['name' => $name]);
        $this->assertDatabaseHas('team_user', [
            'user_id'  => $user->id,
            'team_id'  => $team->id,
            'is_owner' => 1,
        ]);
    }

    /** @test */
    public function should_update_team()
    {
        // Given
        $user = factory(User::class)->create();
        $header = $this->getAuthHeader($user);

        $teamName1 = 'TEAM_NAME_1';
        $team = factory(Team::class)->create(['name' => $teamName1]);

        $teamName2 = 'TEAM_NAME_2';

        $data = [
            'id'   => $team->id,
            'name' => $teamName2,
        ];

        // When
        $response = $this->postJson(route('team.update'), $data, $header);

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
            'id'   => $team->id,
            'name' => $teamName2,
        ];

        // When
        $header = $this->getAuthHeader($otherUser);
        $response = $this->postJson(route('team.update'), $data, $header);

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
}
