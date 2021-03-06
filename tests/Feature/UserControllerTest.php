<?php

namespace Tests\Feature;

use App\Models\Role;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Tests\ApiTestCase;

class UserControllerTest extends ApiTestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function should_register_user()
    {
        // Given
        $data =
            [
                'name'                  => 'USER_NAME',
                'email'                 => 'EMAIL@EMAIL.COM',
                'password'              => 'PASSWORD',
                'password_confirmation' => 'PASSWORD'
            ];

        // When
        $response = $this->post(route('api.register'), $data);

        // Then
        $response->assertStatus(HttpResponse::HTTP_FOUND);
        $this->assertDatabaseHas('users', ['email' => 'EMAIL@EMAIL.COM']);
    }

    /** @test */
    public function should_assign_user()
    {
        // Given
        $role1 = Role::where('alias', Role::APP_INI_USER_ROLE)->first();
        $role2 = Role::where('alias', Role::STANDARD_USER_ROLE)->first();

        // When
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        // Then
        $this->assertDatabaseHas('role_user', [
            'user_id' => $user1->id,
            'role_id' => $role1->id
        ]);
        $this->assertDatabaseHas('role_user', [
            'user_id' => $user2->id,
            'role_id' => $role2->id
        ]);
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
        $response = $this->post(route('api.login'), $data);

        // Then
        $this->assertDatabaseHas('users', ['email' => $email,]);
        $response->assertStatus(HttpResponse::HTTP_FOUND);
        $response->assertJsonStructure(['data' => ['token']]);
    }

    public function should_recover_password()
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

        $data = ['email' => $email];

        Mail::fake();

        // When
        $response = $this->postJson(route('api.user.recover'), $data);

        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
    }


    public function should_remove_user()
    {
        // Given
        $email = 'EMAIL@EMAIL.COM';

        $user = factory(User::class)->create(
            [
                'email' => $email,
            ]
        );

        // When
        $response = $this->postJson(route('api.user.un-register'), ['email' => $email], $this->getAuthHeader($user));


        // Then
        $response->assertStatus(HttpResponse::HTTP_OK);
        $this->assertDatabaseMissing('users',
            [
                'email' => $email,
            ]
        );
    }
}
