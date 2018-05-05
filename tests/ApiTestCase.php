<?php

namespace Tests;

use App\Models\MlModelPredictionScore;
use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class ApiTestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp()
    {
        parent::setUp();

        Artisan::call('db:seed', [
            '--database' => env('DB_CONNECTION')
        ]);

        MlModelPredictionScore::truncate();
    }

    protected function getAuthHeader(User $user)
    {
        $this->be($user);
        $token = auth()->tokenById($user->id);

        return ['Authorization' => 'Bearer ' . $token];
    }
}
