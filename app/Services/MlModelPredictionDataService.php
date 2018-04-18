<?php

namespace App\Services;

use App\Models\MlModelPrediction;
use App\Repositories\MlModelPredictionDataRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class MlModelPredictionDataService
{
    /** @var MlModelPredictionDataRepository */
    private $mlModelPredictionDataRepository;

    /**
     * MlModelStatePredictionDataService constructor.
     *
     * @param MlModelPredictionDataRepository $mlModelPredictionDataRepository
     */
    public function __construct(MlModelPredictionDataRepository $mlModelPredictionDataRepository)
    {
        $this->mlModelPredictionDataRepository = $mlModelPredictionDataRepository;
    }

    /**
     * Creates a new training data entry.
     *
     * @param MlModelPrediction $prediction
     *
     * @param                   $file
     *
     * @param                   $mime
     *
     * @return Model
     */
    public function create(MlModelPrediction $prediction, $file, $mime)
    {
        $state = $prediction->model->getCurrentState();

        $params['ml_algorithm_id'] = $state->algorithm->id;
        $params['params'] = $state->params;
        $params['mime_type'] = $mime;
        $params['data'] = $file;

        return $this->mlModelPredictionDataRepository->create($params);
    }

    /**
     * @param MlModelPrediction $prediction
     *
     * @param UploadedFile      $file
     *
     * @param null              $mime
     *
     * @return Model
     */
    public function update(MlModelPrediction $prediction, $file = null, $mime = null)
    {
        $state = $prediction->model->getCurrentState();

        $params['ml_algorithm_id'] = $state->algorithm->id;
        $params['params'] = $state->params;
        if (!is_null($file)) {
            $params['mime_type'] = $mime;
            $params['data'] = $file;
        }

        $predictionData = $this->mlModelPredictionDataRepository->findOneOrFailById($prediction->predictionData->id);

        return $this->mlModelPredictionDataRepository->update($predictionData, $params);
    }
}
