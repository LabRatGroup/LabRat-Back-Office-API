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
        $model = MlAlgorithm::where('alias', 'kNN')->first();

        MlAlgorithmParam::create([
            'name'            => 'k',
            'description'     => '',
            'key'             => 'k',
            'low_range'       => 1,
            'high_range'      => 100,
            'step'            => 1,
            'ml_algorithm_id' => $model->id,
        ]);

        /** @var MlAlgorithm $model */
        $model = MlAlgorithm::where('alias', 'nb')->first();

        MlAlgorithmParam::create([
            'name'            => 'k',
            'description'     => '',
            'key'             => 'k',
            'low_range'       => 1,
            'high_range'      => 100,
            'step'            => 1,
            'ml_algorithm_id' => $model->id,
        ]);
    }
}
