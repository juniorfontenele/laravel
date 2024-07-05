<?php

namespace App\Console\Commands\Base;

use App\Services\AppService;
use Illuminate\Console\Command;

class GenerateAppVersion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-version-file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates application version file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $appVersion = AppService::version();
        AppService::writeVersion();
        $this->info("Wrote file version: $appVersion");
    }
}
