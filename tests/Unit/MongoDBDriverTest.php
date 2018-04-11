<?php

namespace Tests\Feature;

use App\Models\MlModelStateTrainingData;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MongoDBDriverTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function should_store_data()
    {
        $model = New MlModelStateTrainingData();
        $model->trainData = "FILE_DATA";
        $model->save();

        /** @var MlModelStateTrainingData $modelOut */
        $modelOut = $model->find($model->getQueueableId());

        $this->assertInstanceOf(MlModelStateTrainingData::class, $model);
        $this->assertInstanceOf(MlModelStateTrainingData::class, $modelOut);
        $this->assertEquals($model->getQueueableId(), $modelOut->getQueueableId());
    }
}
