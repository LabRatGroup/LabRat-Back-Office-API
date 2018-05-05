<?php

namespace Tests;

use App\Models\MlModelPredictionScore;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
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
}
