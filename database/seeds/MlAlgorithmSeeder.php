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
            'name'          => 'k-Nearest Neighbor',
            'description'   => 'The k-NN algorithm is a classification method that intents to match, or classify, an unknown subject to a category or label based on its similarity to other related and well known elements. k-NN is a classification by similarity algorithm. The total numbers of elements to consider when classifying is given by k.',
            'type'          => 'Classification',
            'alias'         => 'knn',
            'default_value' => json_encode([
                'method'        => 'knn',
                'preprocessing' => 'center',
                'metric'        => 'Accuracy',
                'control'       => [
                    'trainControlMethodRounds' => 3,
                    'trainControlMethod'       => 'cv',
                ],
            ]),
        ]);

        MlAlgorithm::create([
            'name'        => 'Naive Bayes',
            'description' => 'The Naive Bayes algorithm describes a simple method to apply Bayes\' theorem to classi cation problems. Naive Bayes is one of the simplest classification algorithms, but it can also be very accurate. At a high level, Naive Bayes tries to classify instances based on the probabilities of previously seen attributes/instances, assuming complete attribute independence',
            'type'        => 'Classification',
            'alias'       => 'nb',
            'default_value' => json_encode([
                'method'        => 'nb',
                'preprocessing' => 'center',
                'metric'        => 'Accuracy',
                'control'       => [
                    'trainControlMethodRounds' => 3,
                    'trainControlMethod'       => 'cv',
                ],
            ]),
        ]);

        MlAlgorithm::create([
            'name'        => 'Artificial Neural Network',
            'description' => '',
            'type'        => 'Dual use',
            'alias'       => 'nnet',
            'default_value' => json_encode([
                'method'        => 'nnet',
                'preprocessing' => 'center',
                'metric'        => 'Accuracy',
                'control'       => [
                    'trainControlMethodRounds' => 3,
                    'trainControlMethod'       => 'cv',
                ],
            ]),
        ]);

        MlAlgorithm::create([
            'name'        => 'Linear Support Vector Machines',
            'description' => '',
            'type'        => 'Dual use',
            'alias'       => 'svmLinear',
            'default_value' => json_encode([
                'method'        => 'svmLinear',
                'preprocessing' => 'center',
                'metric'        => 'Accuracy',
                'control'       => [
                    'trainControlMethodRounds' => 3,
                    'trainControlMethod'       => 'cv',
                ],
            ]),
        ]);

        MlAlgorithm::create([
            'name'        => 'Radial Support Vector Machines',
            'description' => '',
            'type'        => 'Dual use',
            'alias'       => 'svmRadial',
            'default_value' => json_encode([
                'method'        => 'svmRadial',
                'preprocessing' => 'center',
                'metric'        => 'Accuracy',
                'control'       => [
                    'trainControlMethodRounds' => 3,
                    'trainControlMethod'       => 'cv',
                ],
            ]),
        ]);

        MlAlgorithm::create([
            'name'        => 'Decision Tree',
            'description' => '',
            'type'        => 'Classification',
            'alias'       => 'C5.0',
            'default_value' => json_encode([
                'method'        => 'C5.0',
                'preprocessing' => 'center',
                'metric'        => 'Accuracy',
                'control'       => [
                    'trainControlMethodRounds' => 3,
                    'trainControlMethod'       => 'cv',
                ],
            ]),
        ]);

        MlAlgorithm::create([
            'name'        => 'Random Forests',
            'description' => '',
            'type'        => 'Classification',
            'alias'       => 'rf',
            'default_value' => json_encode([
                'method'        => 'rf',
                'preprocessing' => 'center',
                'metric'        => 'Accuracy',
                'control'       => [
                    'trainControlMethodRounds' => 3,
                    'trainControlMethod'       => 'cv',
                ],
            ]),
        ]);
    }
}
