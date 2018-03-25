<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiController;
use App\Repositories\MlModelRepository;

class MlModelController extends ApiController
{
    /**
     * @var MlModelRepository
     */
    private $mlModelRepository;

    /**
     * MlModelController constructor.
     *
     * @param MlModelRepository $mlModelRepository
     */
    public function __construct(MlModelRepository $mlModelRepository)
    {
        $this->mlModelRepository = $mlModelRepository;
    }
}
