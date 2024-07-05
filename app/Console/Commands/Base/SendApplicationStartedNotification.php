<?php

namespace App\Console\Commands\Base;

use App\Events\App\ApplicationStarted;
use Illuminate\Console\Command;

class SendApplicationStartedNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:started';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send application started event';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        event(new ApplicationStarted);
    }
}
