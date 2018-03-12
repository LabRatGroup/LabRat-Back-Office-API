<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function should_register_user()
    {
        // Given
        $data = [
            'name'     => 'USER_NAME',
            'email'    => 'EMAIL@EMAIL.COM',
            'password' => 'PASSWORD',
        ];

        // When
        $response = $this->postJson('/api/register', $data);


        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonStructure(
            [
                'data' => ['token',],
            ]
        );

        $this->assertDatabaseHas('users',
            [
                'email' => 'EMAIL@EMAIL.COM',
            ]
        );
    }

    public function should_login_user()
    {
        // Given
        $email = 'EMAIL@EMAIL.COM';
        $password = 'PASSWORD';

        factory(User::class)->create(
            [
                'name'     => 'USER_NAME',
                'email'    => $email,
                'password' => $password,
            ]
        );

        $data =
            [
                'email'    => $email,
                'password' => $password,
            ];

        // When
        $response = $this->postJson('/api/login', $data);

        // Then
        $this->assertDatabaseHas('users', ['email' => $email,]);
        $response->assertStatus(HttpResponse::HTTP_OK);
        $response->assertJsonStructure(
            [
                'data' => ['token',],
            ]
        );
    }
}
