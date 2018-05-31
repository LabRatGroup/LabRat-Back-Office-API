<?php

namespace App\Jobs;

use App\Models\MlModelPrediction;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class RunMachineLearningPredictionScript implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 1;
    public $timeout = 500;

    /** @var MlModelPrediction */
    protected $prediction;

    /**
     * Create a new job instance.
     *
     * @param MlModelPrediction $prediction
     */
    public function __construct(MlModelPrediction $prediction)
    {
        $this->prediction = $prediction;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $token = $this->prediction->token;
        Log::info('Launching prediction job for data ' . $token);

        $client = new Client();
        $client->get('http://' . env('ML_HOST') . ':' . env('ML_PORT') . '/predict/' . $token);
        $this->runHappyPath();
    }

    /**
     * @param Exception $exception
     */
    public function failed(Exception $exception)
    {
        $this->prediction->load('score');
        if ($this->prediction->score->count() > 0) {
            $this->runHappyPath();
        } else {
            $this->prediction->setStatus("500");
        }
    }

    private function runHappyPath()
    {
        Log::info('Status for prediction job  ' . $this->prediction->title . ': 200 Ok');
        $this->prediction->setStatus("200");
    }
}
