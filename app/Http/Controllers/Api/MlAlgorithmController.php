<?php

namespace App\Http\Controllers\Api;

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
}
