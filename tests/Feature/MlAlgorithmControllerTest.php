<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Tests\ApiTestCase;

class MlAlgorithmControllerTest extends ApiTestCase
{
    use RefreshDatabase;

    /** @test */
    public function should_get_ml_algorithm_list()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        // When
        $response = $this->actingAs($user)->get(route('api.algorithm.index'));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['name']);
    }

    /** @test */
    public function should_get_ml_algorithm_with_params()
    {
        // Given
        $user = factory(User::class)->create();
        $this->be($user);

        // When
        $response = $this->actingAs($user)->get(route('api.algorithm.show', ['id' => '5']));

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonFragment(['classType']);
    }
}
