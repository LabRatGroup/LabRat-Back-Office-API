<?php

namespace Tests\Feature;

use App\Models\MlModelPredictionScore;
use App\Models\MlModelStateTrainingData;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MongoDBDriverTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function should_store_data()
    {
        $model = New MlModelPredictionScore();
        $model->data = "FILE_DATA";
        $model->save();

        /** @var MlModelPredictionScore $modelOut */
        $modelOut = $model->find($model->getQueueableId());

        $this->assertInstanceOf(MlModelPredictionScore::class, $model);
        $this->assertInstanceOf(MlModelPredictionScore::class, $modelOut);
        $this->assertEquals($model->getQueueableId(), $modelOut->getQueueableId());
    }
}
