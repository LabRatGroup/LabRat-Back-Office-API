<?php

namespace App\Jobs;

use App\Models\MlModelPrediction;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

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
        //
    }
}
