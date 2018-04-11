<?php

namespace App\Services;

use App\Models\MlModelState;
use App\Models\MlModelStateTrainingData;
use App\Repositories\MlModelStateTrainingDataRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class MlModelStateTrainingDataService
{
    /** @var MlModelStateTrainingDataRepository */
    private $mlModelStateTrainingDataRepository;

    /**
     * MlModelStateTrainingDataService constructor.
     *
     * @param MlModelStateTrainingDataRepository $mlModelStateTrainingDataRepository
     */
    public function __construct(MlModelStateTrainingDataRepository $mlModelStateTrainingDataRepository)
    {
        $this->mlModelStateTrainingDataRepository = $mlModelStateTrainingDataRepository;
    }

    /**
     * Creates a new training data entry.
     *
     * @param UploadedFile $file
     *
     * @param MlModelState $state
     *
     * @return Model
     */
    public function create(UploadedFile $file, MlModelState $state)
    {
        $params['algorithm'] = json_encode($state->algorithm);
        $params['params'] = $state->params;
        $params['mime_type'] = $file->getMimeType();
        $params['data'] = $file->openFile('r')->fread($file->getSize());

        return $this->mlModelStateTrainingDataRepository->create($params);
    }

    /**
     * Creates a new training data entry from another onw.
     *
     * @param MlModelStateTrainingData $trainingData
     * @param MlModelState             $state
     *
     * @return Model
     */
    public function copy(MlModelStateTrainingData $trainingData, MlModelState $state)
    {
        $params['algorithm'] = json_encode($state->algorithm);
        $params['params'] = $state->params;
        $params['mime_type'] = $trainingData->mime_type;
        $params['data'] = $trainingData->data;

        return $this->mlModelStateTrainingDataRepository->create($params);
    }
}
