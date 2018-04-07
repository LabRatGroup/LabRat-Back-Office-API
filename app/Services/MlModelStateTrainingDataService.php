<?php

namespace App\Services;

use App\Models\MlModelState;
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
     * @param UploadedFile $file
     *
     * @param MlModelState $mlModelState
     *
     * @return Model
     */
    public function create(UploadedFile $file, MlModelState $mlModelState)
    {
        $params['file_name'] = $file->getFilename();
        $params['file_extension'] = $file->extension();
        $params['ml_model_state_id'] = $mlModelState->id;

        return $this->mlModelStateTrainingDataRepository->create($params);
    }
}
