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
            'type'        => 'Classification',
            'alias'       => 'knn',
        ]);

        MlAlgorithm::create([
            'name'        => 'Naive Bayes',
            'description' => 'The Naive Bayes algorithm describes a simple method to apply Bayes\' theorem to classi cation problems. Naive Bayes is one of the simplest classification algorithms, but it can also be very accurate. At a high level, Naive Bayes tries to classify instances based on the probabilities of previously seen attributes/instances, assuming complete attribute independence',
            'type'        => 'Classification',
            'alias'       => 'nb',
        ]);

        MlAlgorithm::create([
            'name'        => 'Artificial Neural Network',
            'description' => '',
            'type'        => 'Dual use',
            'alias'       => 'nnet',
        ]);

        MlAlgorithm::create([
            'name'        => 'Linear Support Vector Machines',
            'description' => '',
            'type'        => 'Dual use',
            'alias'       => 'svmLinear',
        ]);

        MlAlgorithm::create([
            'name'        => 'Radial Support Vector Machines',
            'description' => '',
            'type'        => 'Dual use',
            'alias'       => 'svmRadial',
        ]);

        MlAlgorithm::create([
            'name'        => 'Decision Tree',
            'description' => '',
            'type'        => 'Classification',
            'alias'       => 'C5.0',
        ]);

        MlAlgorithm::create([
            'name'        => 'Random Forests',
            'description' => '',
            'type'        => 'Classification',
            'alias'       => 'rf',
        ]);
    }
}
