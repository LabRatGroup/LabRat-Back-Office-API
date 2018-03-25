<?php

use App\Models\MlAlgorithm;
use Illuminate\Database\Seeder;

class MlAlgorithmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MlAlgorithm::create([
            'name'        => 'k-Nearest Neighbor',
            'description' => 'The k-NN algorithm is a classification method that intents to match, or classify, an unknown subject to a category or label based on its similarity to other related and well known elements. k-NN is a classification by similarity algorithm. The total numbers of elements to consider when classifying is given by k.',
            'alias'       => 'kNN',
        ]);

        MlAlgorithm::create([
            'name'        => 'Naive Bayes',
            'description' => '',
            'alias'       => 'nb',
        ]);

        MlAlgorithm::create([
            'name'        => 'Artificial Neural Network',
            'description' => '',
            'alias'       => 'nnet',
        ]);

        MlAlgorithm::create([
            'name'        => 'Linear Support Vector Machines',
            'description' => '',
            'alias'       => 'svmLinear',
        ]);

        MlAlgorithm::create([
            'name'        => 'Radial Support Vector Machines',
            'description' => '',
            'alias'       => 'svmRadial',
        ]);

        MlAlgorithm::create([
            'name'        => 'Decision Tree',
            'description' => '',
            'alias'       => 'C5.0',
        ]);

        MlAlgorithm::create([
            'name'        => 'Random Forests',
            'description' => '',
            'alias'       => 'rf',
        ]);
    }
}
