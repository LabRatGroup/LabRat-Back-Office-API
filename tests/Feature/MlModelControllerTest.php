<?php

namespace Tests\Feature;

use App\Models\Project;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class MlModelControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function should_create_model()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        $modelTitle = 'MODEL_TITLE';
        $project = factory(Project::class)->create();

        $data = [
            'title'      => $modelTitle,
            'project_id' => $project->id,
        ];

        // When
        $response = $this->postJson(route('model.create'), $data, $this->getAuthHeader($user));

        // Then
        $response->assertStatus(HttpResponse::HTTP_CREATED);
        $response->assertJsonFragment(['title' => $modelTitle]);
        $this->assertDatabaseHas('ml_models',
            [
                'title'      => $modelTitle,
                'project_id' => $project->id,
            ]
        );
    }

    /** @test */
    public function non_project_owner_should_not_create_model()
    {
        // Given
        $user = factory(User::class)->create();
        $member = factory(User::class)->create();
        $this->be($user);

        $modelTitle = 'MODEL_TITLE';
        $project = factory(Project::class)->create();

        $data = [
            'title'      => $modelTitle,
            'project_id' => $project->id,
        ];

        // When
        $response = $this->postJson(route('model.create'), $data, $this->getAuthHeader($member));

        // Then
        $response->assertStatus(HttpResponse::HTTP_FORBIDDEN);
        $this->assertDatabaseMissing('ml_models',
            [
                'title'      => $modelTitle,
                'project_id' => $project->id,
            ]
        );
    }
}
