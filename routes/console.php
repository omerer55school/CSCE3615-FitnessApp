<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/**
 * Register an Artisan command that displays an inspiring quote.
 *
 * This command can be executed using the 'inspire' command in Artisan CLI.
 */
Artisan::command('inspire', function () {
    // Display an inspiring quote using the Inspiring facade
    $this->comment(Inspiring::quote());
})
    ->purpose('Display an inspiring quote') // Set the purpose of the command
    ->hourly(); // Schedule the command to run hourly
