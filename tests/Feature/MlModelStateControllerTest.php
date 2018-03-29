<?php

namespace Tests\Feature;

use App\Models\MlAlgorithm;
use App\Models\MlModel;
use App\Models\Project;
use App\Models\Role;
use App\Models\Team;
use App\User;
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
}
