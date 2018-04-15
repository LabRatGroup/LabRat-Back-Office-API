<?php

namespace Tests;

use App\Models\MlModelPredictionData;
use App\Models\MlModelPredictionScore;
use App\Models\MlModelStateTrainingData;
use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp()
    {
        parent::setUp();

        Artisan::call('db:seed', [
            '--database' => 'sqlite_testing'
        ]);

        MlModelStateTrainingData::truncate();
        MlModelPredictionData::truncate();
        MlModelPredictionScore::truncate();
    }

    protected function getAuthHeader(User $user)
    {
        $this->be($user);
        $token = auth()->tokenById($user->id);

        return ['Authorization' => 'Bearer ' . $token];
    }
}
