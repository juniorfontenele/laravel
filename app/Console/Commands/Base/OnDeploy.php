<?php

namespace App\Console\Commands\Base;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class OnDeploy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:on-deploy {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs on deploy (entrypoint.sh)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $isolated = '';

        $this->info('🎬 Application environment: '.app()->environment());
        $this->info('🎬 Running deploy commands...');

        if (! app()->environment('local') || $this->option('force')) {
            if (Schema::hasTable('cache_locks')) {
                $isolated = '--isolated';
            }

            $this->info('🎬 Running migrations...');
            Artisan::call('migrate --no-interaction --force '.$isolated);
            $this->info('🎬 Migrations done!');
        }

        if (app()->environment('production')) {
            $this->info('🎬 Caching files...');
            Artisan::call('config:cache');
            Artisan::call('route:cache');
            Artisan::call('view:cache');
            $this->info('🎬 Caching done!');
        }

        $this->info('🎬 Deploy commands done!');
    }
}
