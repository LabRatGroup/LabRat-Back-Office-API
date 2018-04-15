<?php

namespace App\Console\Commands;

use App\Services\MlModelService;
use Illuminate\Console\Command;

class UpdateModelPredictions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'labrat:updateModelPredictions {token}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates all registered predictions predictions under a certain model token.';

    /** @var MlModelService */
    private $mlModelService;

    /**
     * UpdateModelPredictions constructor.
     *
     * @param MlModelService $mlModelService
     */
    public function __construct(MlModelService $mlModelService)
    {
        parent::__construct();
        $this->mlModelService = $mlModelService;
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Updating prediction data for model ' . $this->argument('token'));
        $this->mlModelService->reviewModelPerformance($this->argument('token'));
    }
}
