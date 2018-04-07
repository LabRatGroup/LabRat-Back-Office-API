<?php

namespace Tests\Unit;

use App\Models\MlModelState;
use App\Models\MlModelStateTrainingData;
use App\Repositories\MlModelStateTrainingDataRepository;
use App\Services\MlModelStateTrainingDataService;
use Illuminate\Http\UploadedFile;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MlModelStateTrainingDataServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test
     * @throws \ReflectionException
     */
    public function should_store_text_file()
    {
        // Given
        $file = UploadedFile::fake()->create('data.csv', 100000);
        $state = factory(MlModelState::class)->make();
        $stubModel = factory(MlModelStateTrainingData::class)->make([
            'file_name'         => $file->getFilename(),
            'file_extension'    => $file->extension(),
            'ml_model_state_id' => $state->id,
        ]);

        /** @var  MockObject|MlModelStateTrainingDataRepository $mlModelStateTrainingDataRepository */
        $mlModelStateTrainingDataRepository = $this->createMock(MlModelStateTrainingDataRepository::class);
        $mlModelStateTrainingDataRepository->method('create')->willReturn($stubModel);

        $trainingDataService = new MlModelStateTrainingDataService($mlModelStateTrainingDataRepository);

        // When
        $model = $trainingDataService->create($file, $state);

        // Then
        $this->assertInstanceOf(MlModelStateTrainingData::class, $model);
        $this->assertEquals($model->getAttribute('file_name'), $file->getFilename());
        $this->assertEquals($model->getAttribute('file_extension'), $file->extension());
        $this->assertEquals($model->getAttribute('ml_model_state_id'), $state->id);
    }
}
