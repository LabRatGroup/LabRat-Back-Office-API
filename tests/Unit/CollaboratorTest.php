<?php

namespace Tests\Unit;

use App\Models\Role;
use App\Models\Team;
use App\Repositories\TeamRepository;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CollaboratorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function addCollaboratorsIncludeCurentUserOnCreate()
    {
        // Give
        $owner = factory(User::class)->create();
        $collaborator = factory(User::class)->create();
        $role = Role::where('alias', Team::TEAM_DEFAULT_ROLE_ALIAS)->first();

        $this->be($owner);

        $params = [
            'name'  => 'Team title',
            'users' => json_encode(
                [
                    [
                        'id'    => $collaborator->id,
                        'pivot' => [
                            'role_id'  => $role->id,
                            'is_owner' => false,
                        ],
                    ],
                ]
            )
        ];

        $teamRepository = new TeamRepository(new Team());

        // When
        $team = $teamRepository->create($params);
        $team->setCollaborators($params);

        // Then
        $teamUsers = array_column($team->users->toArray(), 'id');
        $this->assertTrue(in_array($collaborator->id, $teamUsers));
        $this->assertTrue(in_array($owner->id, $teamUsers));
    }
}
