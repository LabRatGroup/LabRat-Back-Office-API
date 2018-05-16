<?php

namespace App\Http\Controllers\Api;

use App\Models\MlAlgorithmParam;
use App\Repositories\MlAlgorithmRepository;
use Exception;
use Illuminate\Http\JsonResponse;

class MlAlgorithmController extends ApiController
{
    /** @var MlAlgorithmRepository */
    private $mlAlgorithmRepository;

    /**
     * MlAlgorithmController constructor.
     *
     * @param MlAlgorithmRepository $mlAlgorithmRepository
     */
    public function __construct(MlAlgorithmRepository $mlAlgorithmRepository)
    {
        $this->mlAlgorithmRepository = $mlAlgorithmRepository;
    }

    /**
     * Retrieves all available algorithms.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $algorithms = $this->mlAlgorithmRepository->findAll();

            /** @var MlAlgorithmParam $algorithm */
            foreach ($algorithms as $algorithm) {
                $algorithm->default_value = json_decode($algorithm->default_value);
            }

            return $this->responseOk($algorithms);
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }

    /**
     * Get algorithm by ID with available params.
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function show($id)
    {
        try {
            $algorithm = $this->mlAlgorithmRepository->findOneOrFailById($id);

            return $this->responseOk($algorithm);
        } catch (Exception $e) {
            return $this->responseInternalError($e->getMessage());
        }
    }

    public function getResamplingMethods()
    {
        return $this->responseOk(
            [
                [
                    'name'  => 'k-fold cross-validation',
                    'alias' => 'cv',
                    'tune'  => [
                        'number' => [
                            'description' => 'Number',
                            'low'         => 1,
                            'high'        => 20,
                            'step'        => 1,
                            'default'     => 10,
                        ],
                    ],
                ],
                [
                    'name'  => 'Holdout sampling',
                    'alias' => 'LGOCV',
                    'tune'  => [
                        'p' => [
                            'description' => 'p',
                            'low'     => 0.1,
                            'high'    => 1,
                            'step'    => 0.1,
                            'default' => 0.75
                        ],
                    ],
                ],
                [
                    'name'  => 'Repeated k-fold cross- validation',
                    'alias' => 'repeatedcv',
                    'tune'  => [
                        'number'  => [
                            'description' => 'Number',
                            'low'     => 1,
                            'high'    => 20,
                            'step'    => 1,
                            'default' => 10,
                        ],
                        'repeats' => [
                            'description' => 'Repeats',
                            'low'     => 1,
                            'high'    => 20,
                            'step'    => 1,
                            'default' => 10,
                        ],
                    ],
                ],
                [
                    'name'  => 'Bootstrap sampling',
                    'alias' => 'boot',
                    'tune'  => [
                        'number' => [
                            'description' => 'Number',
                            'low'     => 1,
                            'high'    => 50,
                            'step'    => 1,
                            'default' => 25,
                        ],
                    ],
                ],
                [
                    'name'  => '0.632 bootstrap',
                    'alias' => 'boot632',
                    'tune'  => [
                        'number' => [
                            'description' => 'Number',
                            'low'     => 1,
                            'high'    => 50,
                            'step'    => 1,
                            'default' => 25,
                        ],
                    ],
                ],
                [
                    'name'  => 'Leave-one-out cross-validation',
                    'alias' => 'LOOCV',
                    'tune'  => [],
                ],
            ]
        );
    }
}
