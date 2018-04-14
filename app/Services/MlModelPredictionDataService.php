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
     * @param UploadedFile      $file
     *
     * @param MlModelPrediction $prediction
     *
     * @return Model
     */
    public function create(UploadedFile $file, MlModelPrediction $prediction)
    {
        $state = $prediction->model->getCurrentState();

        $params['algorithm'] = json_encode($state->algorithm);
        $params['params'] = $state->params;
        $params['mime_type'] = $file->getMimeType();
        $params['data'] = $file->openFile('r')->fread($file->getSize());

        return $this->mlModelPredictionDataRepository->create($params);
    }

    /**
     * @param UploadedFile      $file
     * @param MlModelPrediction $prediction
     *
     * @return Model
     */
    public function update(UploadedFile $file, MlModelPrediction $prediction)
    {
        $state = $prediction->model->getCurrentState();

        $params['algorithm'] = json_encode($state->algorithm);
        $params['params'] = $state->params;
        $params['mime_type'] = $file->getMimeType();
        $params['data'] = $file->openFile('r')->fread($file->getSize());

        $predictionData = $this->mlModelPredictionDataRepository->findOneOrFailById($prediction->predictionData->id);

        return $this->mlModelPredictionDataRepository->update($predictionData, $params);
    }
}
