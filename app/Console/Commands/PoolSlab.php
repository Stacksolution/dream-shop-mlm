<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Utility\CronsUtility;

class PoolSlab extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'poolslab:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   
        CronsUtility::cron();
        \Log::info("Successfully check pool slab user income serveing to every day |");
        $this->info('Successfully check pool slab user income serveing to every day !');
    }
}
