<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CronTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cron test';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info(Carbon::now() . ' - carbon hello cron');

        return 0;
    }
}
