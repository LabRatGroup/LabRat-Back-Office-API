<?php

namespace App\Jobs;

use App\Models\MlModelPrediction;
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
        $token = $this->prediction->trainingData->token;
        Log::info('Launching prediction job for data ' . $token);

        $client = new Client();
        $res = $client->get('http://'.env('ML_HOST').':'.env('ML_PORT').'/predict/' . $token);
        echo $res->getStatusCode();
        echo $res->getBody();
    }
}
