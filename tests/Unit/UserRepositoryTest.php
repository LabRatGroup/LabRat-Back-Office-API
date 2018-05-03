<?php

namespace Tests\Unit;

use App\User;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRepositoryTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    /** @test */
    public function should_create_user()
    {
        // Given
        $email = 'EMAIL@EMAIL.COM';
        $name = 'USER_FULL_NAME';
        $pwd = 'PASSWORD';
        $data =
            [
                'email'    => $email,
                'name'     => $name,
                'password' => $pwd,
            ];

        $model = new User();
        $userRepository = new UserRepository($model);

        // When
        /** @var User $user */
        $user = $userRepository->create($data);

        // Then
        $this->assertNotNull($user);
        $this->assertNotNull($user->token);
        $this->assertDatabaseHas('users',
            [
                'email' => $email
            ]
        );
    }
}
