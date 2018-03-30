<?php

namespace App\Jobs;

use App\Models\MlModelState;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

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
        //
    }
}
