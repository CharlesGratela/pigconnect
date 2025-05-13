<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\SendFeedingScheduleNotification;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Add a custom command to send feeding schedule notifications
Artisan::command('send:feeding-schedule-notification', function () {
    $this->call(SendFeedingScheduleNotification::class);
})->purpose('Send feeding schedule notifications');