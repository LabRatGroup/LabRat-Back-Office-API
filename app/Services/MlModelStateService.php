<?php

namespace App\Services;

use App\Models\MlAlgorithm;
use App\Models\MlAlgorithmParam;
use App\Models\MlModel;
use Illuminate\Database\Eloquent\Collection;

class MlModelStateService
{

    public function generateGlobalPredictionParams(MlModel $model)
    {
        $stateParam = [];
        /** @var Collection $algorithms */
        $algorithms = MlAlgorithm::all();


        /** @var MlAlgorithm $algorithm */
        foreach ($algorithms as $algorithm) {
            $params = json_decode($algorithm->default_value, true);
            $params['positive'] = $model->positive;

            $tune = [];
            /** @var MlAlgorithmParam $param */
            foreach ($algorithm->params as $param) {
                $tune[] = json_decode($param->default_value, true);
            }
            $params['tune'] = $tune;
            $stateParam[] = $params;
        }

        return json_encode($stateParam);
    }
}
