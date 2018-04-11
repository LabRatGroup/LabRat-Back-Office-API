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
        $file = UploadedFile::fake()->create('data.csv', 10000);

        /** @var MlModelState $state */
        $state = factory(MlModelState::class)->make();

        /** @var MlModelStateTrainingData $stubModel */
        $stubModel = factory(MlModelStateTrainingData::class)->make([
            'mime_type'         => $file->getMimeType(),
        ]);

        /** @var  MockObject|MlModelStateTrainingDataRepository $mlModelStateTrainingDataRepository */
        $mlModelStateTrainingDataRepository = $this->createMock(MlModelStateTrainingDataRepository::class);
        $mlModelStateTrainingDataRepository->method('create')->willReturn($stubModel);

        $trainingDataService = new MlModelStateTrainingDataService($mlModelStateTrainingDataRepository);

        // When
        $data = $trainingDataService->create($file, $state);

        // Then
        $this->assertInstanceOf(MlModelStateTrainingData::class, $data);
        $this->assertEquals($data->getAttribute('mime_type'), $file->getMimeType());
    }
}
