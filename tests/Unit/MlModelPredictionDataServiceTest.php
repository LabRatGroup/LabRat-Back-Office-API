<?php

namespace Tests\Unit;

use App\Models\MlModel;
use App\Models\MlModelPrediction;
use App\Models\MlModelPredictionData;
use App\Models\MlModelState;
use App\Repositories\MlModelPredictionDataRepository;
use App\Services\MlModelStatePredictionDataService;
use Illuminate\Http\UploadedFile;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MlModelPredictionDataServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test
     * @throws \ReflectionException
     */
    public function should_store_text_file()
    {
        // Given
        $file = UploadedFile::fake()->create('data.csv', 10000);

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->create();

        /** @var MlModel $model */
        $model = factory(MlModel::class)->create();
        $state->setModel($model);

        /** @var MlModelPrediction $prediction */
        $prediction = factory(MlModelPrediction::class)->create();
        $prediction->setModel($model);

        $stubModel = factory(MlModelPredictionData::class)->make([
            'mime_type'         => $file->getMimeType(),
        ]);

        /** @var  MockObject|MlModelPredictionDataRepository $mlModelPredictionDataRepository */
        $mlModelPredictionDataRepository = $this->createMock(MlModelPredictionDataRepository::class);
        $mlModelPredictionDataRepository->method('create')->willReturn($stubModel);

        $predictionDataService = new MlModelStatePredictionDataService($mlModelPredictionDataRepository);

        // When
        $data = $predictionDataService->create($file, $prediction);

        // Then
        $this->assertInstanceOf(MlModelPredictionData::class, $data);
        $this->assertEquals($data->getAttribute('mime_type'), $file->getMimeType());
    }
}
