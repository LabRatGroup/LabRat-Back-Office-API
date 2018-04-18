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
     * @param              $file
     *
     * @param              $mime
     * @param MlModelState $state
     *
     * @return Model
     */
    public function create($file, $mime, MlModelState $state)
    {
        $params['ml_algorithm_id'] = $state->algorithm->id;
        $params['params'] = $state->params;
        $params['mime_type'] = $mime;
        $params['data'] = $file;

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
        $params['ml_algorithm_id'] = $state->algorithm->id;
        $params['params'] = $state->params;
        $params['mime_type'] = $trainingData->mime_type;
        $params['data'] = $trainingData->data;

        return $this->mlModelStateTrainingDataRepository->create($params);
    }
}
