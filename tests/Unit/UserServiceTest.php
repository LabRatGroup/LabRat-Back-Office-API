<?php

namespace Tests\Unit;

use App\User;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserServiceTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    /** @test */
    public function should_create_user()
    {
        // Given
        $email = 'EMAIL@EMAIL.COM';
        $name = 'USER_FULL_NAME';
        $password = 'PASSWORD';
        $data =
            [
                'email'    => $email,
                'name'     => $name,
                'password' => $password,
            ];

        $model = new User();
        $userRepository = new UserRepository($model);
        $userService = new UserService($userRepository);

        // When
        /** @var User $user */
        $user = $userService->create($data);

        // Then
        $this->assertNotNull($user);
        $this->assertEquals($user->getEmail(), $email);
        $this->assertDatabaseHas('users',
            [
                'email' => $email
            ]
        );
    }
}
