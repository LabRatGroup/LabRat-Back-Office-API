<?php

namespace App\Services;

use App\Models\MlModelPrediction;
use App\Repositories\MlModelPredictionRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class MlModelPredictionService
{
    /** @var MlModelPredictionRepository */
    private $mlModelPredictionRepository;

    /**
     * MlModelPredictionRepository constructor.
     *
     * @param MlModelPredictionRepository $mlModelPredictionRepository
     */
    public function __construct(MlModelPredictionRepository $mlModelPredictionRepository)
    {
        $this->mlModelPredictionRepository = $mlModelPredictionRepository;
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

        $params['params'] = $state->params;
        $params['mime_type'] = $mime;
        $params['file_path'] = $file;

        return $this->mlModelPredictionRepository->create($params);
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

        $params['params'] = $state->params;
        if (!is_null($file)) {
            $params['mime_type'] = $mime;
            $params['file_path'] = $file;
        }

        $predictionData = $this->mlModelPredictionRepository->findOneOrFailById($prediction->id);

        return $this->mlModelPredictionRepository->update($predictionData, $params);
    }
}
