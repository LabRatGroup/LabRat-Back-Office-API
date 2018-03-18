<?php

namespace Tests\Feature;

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
        $this->be($user);
        $token = auth()->tokenById($user->id);
        $header = ['Authorization' => 'Bearer ' . $token];

        $name = 'TEAM_NAME';
        $data = ['name' => $name];

        // When
        $response = $this->postJson(route('team.create'), $data, $header);
        $team = DB::table('teams')->where('name', $name)->first();

        // Then
        $response->assertStatus(HttpResponse::HTTP_CREATED);
        $response->assertJsonStructure(['data' => ['name']]);

        $this->assertDatabaseHas('teams', ['name' => $name]);
        $this->assertDatabaseHas('team_user', [
            'user_id' => $user->id,
            'team_id' => $team->id
        ]);
    }
}
