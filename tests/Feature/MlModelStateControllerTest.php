<?php

namespace Tests\Feature;

use App\Models\MlAlgorithm;
use App\Models\MlModel;
use App\Models\MlModelState;
use App\Models\Project;
use App\Models\Role;
use App\Models\Team;
use App\User;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MlModelStateControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function project_user_should_create_model_state()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();
        $model->setProject($project);

        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        $params = [
            'method'        => 'knn',
            'preprocessing' => 'range',
            'metric'        => 'Accuracy',
            'control'       => [
                'trainControlMethodRounds' => 10,
                'trainControlMethod'       => 'cv',
            ],
            'tune'          => [
                'k' => [
                    'mix'  => 2,
                    'max'  => 8,
                    'step' => 1,
                ],
            ],
        ];

        $data = [
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
            'params'          => json_encode($params),
            'file'            => UploadedFile::fake()->create('data.csv', 100000)
        ];

        // When
        $response = $this->postJson(route('state.create'), $data, $this->getAuthHeader($user));

        // Then
        $response->assertStatus(HttpResponse::HTTP_CREATED);
        $this->assertDatabaseHas('ml_model_states', [
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
            'params'          => json_encode($params),
        ]);
    }

    /** @test */
    public function project_team_member_should_create_model_state()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Project::PROJECT_DEFAULT_ROLE_ALIAS)->first();
        $this->be($user);

        /** @var Team $team */
        $team = factory(Team::class)->create();
        $team->users()->attach($member, [
            'is_owner' => 0,
            'role_id'  => $role->id,
        ]);

        /** @var Project $project */
        $project = factory(Project::class)->create();
        $project->teams()->attach($team);

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();
        $model->setProject($project);

        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        $params = [
            'method'        => 'knn',
            'preprocessing' => 'range',
            'metric'        => 'Accuracy',
            'control'       => [
                'trainControlMethodRounds' => 10,
                'trainControlMethod'       => 'cv',
            ],
            'tune'          => [
                'k' => [
                    'mix'  => 2,
                    'max'  => 8,
                    'step' => 1,
                ],
            ],
        ];

        $data = [
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
            'params'          => json_encode($params),
            'file'            => UploadedFile::fake()->create('data.csv', 100000)
        ];

        // When
        $response = $this->postJson(route('state.create'), $data, $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_CREATED);
        $this->assertDatabaseHas('ml_model_states', [
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
        ]);
    }

    /** @test */
    public function no_access_user_should_not_create_model_state()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();
        $model->setProject($project);

        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        $params = [
            'method'        => 'knn',
            'preprocessing' => 'range',
            'metric'        => 'Accuracy',
            'control'       => [
                'trainControlMethodRounds' => 10,
                'trainControlMethod'       => 'cv',
            ],
            'tune'          => [
                'k' => [
                    'mix'  => 2,
                    'max'  => 8,
                    'step' => 1,
                ],
            ],
        ];

        $data = [
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
            'params'          => json_encode($params),
            'file'            => UploadedFile::fake()->create('data.csv', 100000)
        ];

        // When
        $response = $this->postJson(route('state.create'), $data, $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
        $this->assertDatabaseMissing('ml_model_states', [
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
        ]);
    }

    /** @test */
    public function data_file_missing_on_create_model_state()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();
        $model->setProject($project);

        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        $params = [
            'method'        => 'knn',
            'preprocessing' => 'range',
            'metric'        => 'Accuracy',
            'control'       => [
                'trainControlMethodRounds' => 10,
                'trainControlMethod'       => 'cv',
            ],
            'tune'          => [
                'k' => [
                    'mix'  => 2,
                    'max'  => 8,
                    'step' => 1,
                ],
            ],
        ];

        $data = [
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
            'params'          => json_encode($params),
        ];

        // When
        $response = $this->postJson(route('state.create'), $data, $this->getAuthHeader($user));

        // Then
        $response->assertStatus(HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        $this->assertDatabaseMissing('ml_model_states', [
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
            'params'          => json_encode($params),
        ]);
    }

    /** @test */
    public function user_should_delete_model_state()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create();

        $model->setProject($project);
        $state->setModel($model);

        // When
        $response = $this->deleteJson(route('state.delete', ['id' => $state->id]), [], $this->getAuthHeader($user));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $this->assertDatabaseHas('project_user', [
            'project_id' => $project->id,
            'user_id'    => $user->id,
            'is_owner'   => 1,
        ]);
        $this->assertSoftDeleted('ml_model_states', [
            'id' => $state->id,
        ]);
    }

    /** @test */
    public function non_project_owner_should_not_delete_model_state()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create();

        $model->setProject($project);
        $state->setModel($model);

        // When
        $response = $this->deleteJson(route('state.delete', ['id' => $state->id]), [], $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
        $this->assertDatabaseHas('project_user', [
            'project_id' => $project->id,
            'user_id'    => $user->id,
            'is_owner'   => 1,
        ]);
        $this->assertDatabaseHas('ml_model_states', [
            'id'         => $state->id,
            'deleted_at' => null,
        ]);
    }

    /** @test */
    public function project_user_should_list_all_model_states()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Project::PROJECT_DEFAULT_ROLE_ALIAS)->first();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();
        $project->users()->attach($member, ['role_id' => $role->id]);

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create();

        $model->setProject($project);
        $state->setModel($model);

        // When
        $response = $this->get(route('state.index', ['id' => $model->id]), $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['params' => $state->params]);
    }

    /** @test */
    public function team_member_should_list_all_model_states()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Team::TEAM_DEFAULT_ROLE_ALIAS)->first();
        $this->be($user);

        /** @var Team $team */
        $team = factory(Team::class)->create();
        $team->users()->attach($member, ['role_id' => $role->id]);

        /** @var Project $project */
        $project = factory(Project::class)->create();
        $team->projects()->attach($project);

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create();

        $model->setProject($project);
        $state->setModel($model);

        // When
        $response = $this->get(route('state.index', ['id' => $model->id]), $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['params' => $state->params]);
    }

    /** @test */
    public function user_should_not_list_all_model_states()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create();

        $model->setProject($project);
        $state->setModel($model);

        // When
        $response = $this->get(route('state.index', ['id' => $model->id]), $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
    }

    /** @test */
    public function project_user_should_access_model_state()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Project::PROJECT_DEFAULT_ROLE_ALIAS)->first();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();
        $project->users()->attach($member, ['role_id' => $role->id]);

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create();

        $model->setProject($project);
        $state->setModel($model);

        // When
        $response = $this->get(route('state.show', ['id' => $model->id]), $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['params' => $state->params]);
    }

    /** @test */
    public function team_member_should_access_model_state()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Team::TEAM_DEFAULT_ROLE_ALIAS)->first();
        $this->be($user);

        /** @var Team $team */
        $team = factory(Team::class)->create();
        $team->users()->attach($member, ['role_id' => $role->id]);

        /** @var Project $project */
        $project = factory(Project::class)->create();
        $team->projects()->attach($project);

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create();

        $model->setProject($project);
        $state->setModel($model);

        // When
        $response = $this->get(route('state.show', ['id' => $model->id]), $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['params' => $state->params]);
    }

    /** @test */
    public function user_should_not_access_all_model_state()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create();

        $model->setProject($project);
        $state->setModel($model);

        // When
        $response = $this->get(route('state.show', ['id' => $model->id]), $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
    }

    /** @test */
    public function project_user_should_update_state()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Project::PROJECT_DEFAULT_ROLE_ALIAS)->first();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();
        $project->users()->attach($member, ['role_id' => $role->id]);

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create();

        $model->setProject($project);
        $state->setModel($model);

        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        $params = [
            'method'        => 'knn',
            'preprocessing' => 'range',
            'metric'        => 'Accuracy',
            'control'       => [
                'trainControlMethodRounds' => 10,
                'trainControlMethod'       => 'cv',
            ],
            'tune'          => [
                'k' => [
                    'mix'  => 2,
                    'max'  => 8,
                    'step' => 1,
                ],
            ],
        ];

        $data = [
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
            'params'          => json_encode($params),
            'file'            => UploadedFile::fake()->create('data.csv', 100000)
        ];

        // When
        $response = $this->post(route('state.update', ['id' => $state->id]), $data, $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['params' => json_encode($params)]);

        $this->assertCount(2, $model->states);

    }

    /** @test */
    public function project_user_should_update_state_without_file()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Project::PROJECT_DEFAULT_ROLE_ALIAS)->first();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();
        $project->users()->attach($member, ['role_id' => $role->id]);

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create();

        $model->setProject($project);
        $state->setModel($model);

        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        $params = [
            'method'        => 'knn',
            'preprocessing' => 'range',
            'metric'        => 'Accuracy',
            'control'       => [
                'trainControlMethodRounds' => 10,
                'trainControlMethod'       => 'cv',
            ],
            'tune'          => [
                'k' => [
                    'mix'  => 2,
                    'max'  => 8,
                    'step' => 1,
                ],
            ],
        ];

        $data = [
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
            'params'          => json_encode($params),
        ];

        // When
        $response = $this->post(route('state.update', ['id' => $state->id]), $data, $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['params' => json_encode($params)]);

        $this->assertCount(2, $model->states);

    }

    /** @test */
    public function project_member_user_should_not_update_state()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $role = Role::where('alias', Team::TEAM_DEFAULT_ROLE_ALIAS)->first();
        $this->be($user);

        /** @var Team $team */
        $team = factory(Team::class)->create();
        $team->users()->attach($member, ['role_id' => $role->id]);

        /** @var Project $project */
        $project = factory(Project::class)->create();
        $team->projects()->attach($project);

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create();

        $model->setProject($project);
        $state->setModel($model);

        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        $params = [
            'method'        => 'knn',
            'preprocessing' => 'range',
            'metric'        => 'Accuracy',
            'control'       => [
                'trainControlMethodRounds' => 10,
                'trainControlMethod'       => 'cv',
            ],
            'tune'          => [
                'k' => [
                    'mix'  => 2,
                    'max'  => 8,
                    'step' => 1,
                ],
            ],
        ];

        $data = [
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
            'params'          => json_encode($params),
            'file'            => UploadedFile::fake()->create('data.csv', 100000)
        ];

        // When
        $response = $this->post(route('state.update', ['id' => $state->id]), $data, $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['params' => json_encode($params)]);

        $this->assertCount(2, $model->states);
    }

    /** @test */
    public function user_should_not_update_state()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $this->be($user);

        /** @var Team $team */
        $team = factory(Team::class)->create();

        /** @var Project $project */
        $project = factory(Project::class)->create();
        $team->projects()->attach($project);

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create();

        $model->setProject($project);
        $state->setModel($model);

        $algorithm = MlAlgorithm::where('alias', 'knn')->first();

        $params = [
            'method'        => 'knn',
            'preprocessing' => 'range',
            'metric'        => 'Accuracy',
            'control'       => [
                'trainControlMethodRounds' => 10,
                'trainControlMethod'       => 'cv',
            ],
            'tune'          => [
                'k' => [
                    'mix'  => 2,
                    'max'  => 8,
                    'step' => 1,
                ],
            ],
        ];

        $data = [
            'ml_model_id'     => $model->id,
            'ml_algorithm_id' => $algorithm->id,
            'params'          => json_encode($params),
            'file'            => UploadedFile::fake()->create('data.csv', 100000)
        ];

        // When
        $response = $this->post(route('state.update', ['id' => $state->id]), $data, $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
        $this->assertCount(1, $model->states);
    }

    /** @test */
    public function project_user_should_set_model_state_as_active()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        /** @var Project $project */
        $project = factory(Project::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state1 */
        $state1 = factory(MlModelState::class)->create(['is_current' => true]);

        /** @var MlModelState $state2 */
        $state2 = factory(MlModelState::class)->create(['is_current' => false]);

        $model->setProject($project);
        $state1->setModel($model);
        $state2->setModel($model);

        // When
        $response = $this->post(route('state.current', ['id' => $state2->id]), [], $this->getAuthHeader($user));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $this->assertDatabaseHas('ml_model_states', [
            'id'         => $state1->id,
            'is_current' => 0,
        ]);
        $this->assertDatabaseHas('ml_model_states', [
            'id'         => $state2->id,
            'is_current' => 1,
        ]);
    }

    /** @test */
    public function non_project_user_should_set_model_state_as_active()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $this->be($user);

        /** @var Team $team */
        $team = factory(Team::class)->create();

        /** @var Project $project */
        $project = factory(Project::class)->create();
        $team->projects()->attach($project);

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();

        /** @var MlModelState $state1 */
        $state1 = factory(MlModelState::class)->create(['is_current' => true]);

        /** @var MlModelState $state2 */
        $state2 = factory(MlModelState::class)->create(['is_current' => false]);

        $model->setProject($project);
        $state1->setModel($model);
        $state2->setModel($model);

        // When
        $response = $this->post(route('state.current', ['id' => $state2->id]), [], $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
        $this->assertDatabaseHas('ml_model_states', [
            'id'         => $state1->id,
            'is_current' => 1,
        ]);
        $this->assertDatabaseHas('ml_model_states', [
            'id'         => $state2->id,
            'is_current' => 0,
        ]);
    }
}
