<?php

namespace App\Jobs;

use App\Models\MlModelState;
use App\Services\MlModelService;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class RunMachineLearningModelTrainingScript implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 1;
    public $timeout = 300;

    /** @var MlModelState */
    protected $state;

    /** @var MlModelService */
    protected $mlModelService;

    /**
     * RunMachineLearningModelTrainingScript constructor.
     *
     * @param MlModelState   $state
     * @param MlModelService $mlModelService
     */
    public function __construct(MlModelState $state, MlModelService $mlModelService)
    {
        $this->state = $state;
        $this->mlModelService = $mlModelService;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $token = $this->state->trainingData->token;
        Log::info('Launching model training job for data ' . $token);

        $client = new Client();
        $res = $client->get('http://' . env('ML_HOST') . ':' . env('ML_PORT') . '/train/' . $token);

        Log::info('Status for training job ' . $token . ': ' . $res->getStatusCode());

        $this->state->setStatus($res->getStatusCode());

        if ($this->state->model->states->count() > 1) {
            $this->mlModelService->reviewModelPerformance($this->state->model->token);
        } else {
            $this->state->setIsCurrent(true);
        }
    }

    /**
     * @param Exception $exception
     */
    public function failed(Exception $exception)
    {
        $this->state->setStatus($exception->getCode());
    }
}
