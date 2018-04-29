<?php

use App\Models\MlAlgorithm;
use App\Models\MlAlgorithmParam;
use Illuminate\Database\Seeder;

class MlAlgorithmParamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var MlAlgorithm $model */
        $model = MlAlgorithm::where('alias', 'knn')->first();

        MlAlgorithmParam::create([
            'name'            => 'Number of Neighbors ',
            'description'     => 'Total neighbors threshold needed for prediction.',
            'key'             => 'k',
            'low_range'       => 1,
            'high_range'      => 10,
            'step'            => 1,
            'classType'       => 'numeric',
            'options'         => null,
            'default_value'   => json_encode([
                'k' => [
                    'min'  => 2,
                    'max'  => 5,
                    'step' => 1,
                ],
            ]),
            'ml_algorithm_id' => $model->id,
        ]);

        /** @var MlAlgorithm $model */
        $model = MlAlgorithm::where('alias', 'nb')->first();

        MlAlgorithmParam::create([
            'name'            => 'Laplace correction',
            'description'     => '',
            'key'             => 'fl',
            'low_range'       => 1,
            'high_range'      => 10,
            'step'            => 0.5,
            'classType'       => 'numeric',
            'options'         => null,
            'default_value'   => json_encode([
                'fl' => [
                    'min'  => 2,
                    'max'  => 5,
                    'step' => 1,
                ],
            ]),
            'ml_algorithm_id' => $model->id,
        ]);

        MlAlgorithmParam::create([
            'name'            => 'Distribution type',
            'description'     => '',
            'key'             => 'usekernel',
            'low_range'       => null,
            'high_range'      => null,
            'step'            => null,
            'classType'       => 'logical',
            'options'         => null,
            'default_value'   => json_encode([
                'usekernel' => [
                    'value' => true,
                ],
            ]),
            'ml_algorithm_id' => $model->id,
        ]);


        MlAlgorithmParam::create([
            'name'          => 'Bandwidth Adjustment',
            'description'   => '',
            'key'           => 'adjust',
            'low_range'     => 1,
            'high_range'    => 10,
            'step'          => 0.5,
            'classType'     => 'numeric',
            'options'       => null,
            'default_value' => json_encode([
                'adjust' => [
                    'min'  => 2,
                    'max'  => 5,
                    'step' => 1,
                ],
            ]),
            'ml_algorithm_id' => $model->id,
        ]);

        /** @var MlAlgorithm $model */
        $model = MlAlgorithm::where('alias', 'nnet')->first();

        MlAlgorithmParam::create([
            'name'            => 'Number of Hidden Units ',
            'description'     => '',
            'key'             => 'size',
            'low_range'       => 1,
            'high_range'      => 10,
            'step'            => 1,
            'classType'       => 'numeric',
            'options'         => null,
            'default_value'   => json_encode([
                'size' => [
                    'min'  => 2,
                    'max'  => 5,
                    'step' => 1,
                ],
            ]),
            'ml_algorithm_id' => $model->id,
        ]);

        MlAlgorithmParam::create([
            'name'          => 'Weight Decay',
            'description'   => '',
            'key'           => 'decay',
            'low_range'     => 1,
            'high_range'    => 10,
            'step'          => 1,
            'classType'     => 'numeric',
            'options'       => null,
            'default_value' => json_encode([
                'decay' => [
                    'min'  => 2,
                    'max'  => 5,
                    'step' => 1,
                ],
            ]),
            'ml_algorithm_id' => $model->id,
        ]);

        /** @var MlAlgorithm $model */
        $model = MlAlgorithm::where('alias', 'svmLinear')->first();

        MlAlgorithmParam::create([
            'name'            => 'Cost',
            'description'     => '',
            'key'             => 'C',
            'low_range'       => 1,
            'high_range'      => 10,
            'step'            => 1,
            'classType'       => 'numeric',
            'options'         => null,
            'default_value'   => json_encode([
                'C' => [
                    'min'  => 2,
                    'max'  => 5,
                    'step' => 1,
                ],
            ]),
            'ml_algorithm_id' => $model->id,
        ]);

        /** @var MlAlgorithm $model */
        $model = MlAlgorithm::where('alias', 'svmRadial')->first();

        MlAlgorithmParam::create([
            'name'            => 'Cost',
            'description'     => '',
            'key'             => 'C',
            'low_range'       => 1,
            'high_range'      => 10,
            'step'            => 1,
            'classType'       => 'numeric',
            'options'         => null,
            'default_value'   => json_encode([
                'C' => [
                    'min'  => 2,
                    'max'  => 5,
                    'step' => 1,
                ],
            ]),
            'ml_algorithm_id' => $model->id,
        ]);

        MlAlgorithmParam::create([
            'name'            => 'Sigma',
            'description'     => '',
            'key'             => 'sigma',
            'low_range'       => 1,
            'high_range'      => 10,
            'step'            => 1,
            'classType'       => 'numeric',
            'options'         => null,
            'default_value'   => json_encode([
                'sigma' => [
                    'min'  => 2,
                    'max'  => 5,
                    'step' => 1,
                ],
            ]),
            'ml_algorithm_id' => $model->id,
        ]);

        /** @var MlAlgorithm $model */
        $model = MlAlgorithm::where('alias', 'C5.0')->first();

        MlAlgorithmParam::create([
            'name'            => 'Model Type',
            'description'     => '',
            'key'             => 'model',
            'low_range'       => null,
            'high_range'      => null,
            'step'            => null,
            'classType'       => 'character',
            'options'         => '[A,B,C]',
            'default_value'   => json_encode([
                'model' => [
                    'value' => 'A',
                ],
            ]),
            'ml_algorithm_id' => $model->id,
        ]);

        MlAlgorithmParam::create([
            'name'            => 'Number of Boosting Iterations ',
            'description'     => '',
            'key'             => 'trials',
            'low_range'       => 1,
            'high_range'      => 10,
            'step'            => 1,
            'classType'       => 'numeric',
            'options'         => null,
            'default_value'   => json_encode([
                'trials' => [
                    'min'  => 2,
                    'max'  => 5,
                    'step' => 1,
                ],
            ]),
            'ml_algorithm_id' => $model->id,
        ]);

        MlAlgorithmParam::create([
            'name'            => 'Winnow',
            'description'     => '',
            'key'             => 'winnow',
            'low_range'       => null,
            'high_range'      => null,
            'step'            => null,
            'classType'       => 'logical',
            'options'         => null,
            'default_value'   => json_encode([
                'winnow' => [
                    'value' => 'true',
                ],
            ]),
            'ml_algorithm_id' => $model->id,
        ]);

        /** @var MlAlgorithm $model */
        $model = MlAlgorithm::where('alias', 'rf')->first();

        MlAlgorithmParam::create([
            'name'            => 'Number of Randomly Selected Predictors',
            'description'     => '',
            'key'             => 'mtry',
            'low_range'       => 1,
            'high_range'      => 10,
            'step'            => 1,
            'classType'       => 'numeric',
            'options'         => null,
            'default_value'   => json_encode([
                'mtry' => [
                    'min'  => 2,
                    'max'  => 5,
                    'step' => 1,
                ],
            ]),
            'ml_algorithm_id' => $model->id,
        ]);
    }
}
