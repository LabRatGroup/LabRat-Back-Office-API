<?php

namespace App\Jobs;

use App\Models\MlModelState;
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

    /** @var MlModelState */
    protected $state;

    /**
     * Create a new job instance.
     *
     * @param MlModelState $state
     */
    public function __construct(MlModelState $state)
    {
        $this->state = $state;
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
        //$token = 'OEl8Wev85Tmb53FIWUDhI8lgA';
        $client = new Client();
        $res = $client->get('http://127.0.0.1:3000/train/' . $token);
        echo $res->getStatusCode(); // 200
        echo $res->getBody(); // { "type": "User", ....
    }
}
