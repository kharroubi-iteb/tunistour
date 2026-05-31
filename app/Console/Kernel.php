<?php

namespace App\Console;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule($schedule): void
    {
        // No scheduled jobs needed
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        // Loader for default artisan commands
    }
}
