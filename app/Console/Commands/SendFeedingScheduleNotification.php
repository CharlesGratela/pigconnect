<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\FeedingSchedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SendFeedingScheduleNotification extends Command
{
    protected $signature = 'app:send:feeding-schedule-notification';
    protected $description = 'Send email notifications about the feeding schedule';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            // Set the timezone to Asia/Manila and get the current time
            $currentHour = Carbon::now('Asia/Manila')->format('H:i');
            Log::info("Current Hour: {$currentHour}");

            // Calculate the time one hour from now
            $oneHourLater = Carbon::now('Asia/Manila')->addHour()->format('H:i');
            Log::info("One Hour Later: {$oneHourLater}");

            // Find feeding schedules that match the time one hour from now
            $feedingSchedules = FeedingSchedule::all();
            Log::info("Feeding Schedules: ", $feedingSchedules->toArray());

            foreach ($feedingSchedules as $schedule) {
                $feedingTimes = json_decode($schedule->feeding_times, true);
                Log::info("Feeding Times for Schedule ID {$schedule->id}: ", $feedingTimes);

                if (in_array($oneHourLater, $feedingTimes)) {
                    $user = User::find($schedule->user_id);
                    if ($user) {
                        Log::info("Sending email to: {$user->email}");
                        Mail::raw("Reminder: Your feeding schedule is at {$oneHourLater}.", function ($message) use ($user) {
                            $message->to($user->email) // Access the user's email address
                                    ->subject('Feeding Schedule Reminder');
                        });
                    } else {
                        Log::warning("User not found for user_id: {$schedule->user_id}");
                    }
                }
            }

            $this->info('Feeding schedule notifications sent successfully.');
        } catch (\Exception $e) {
            Log::error("Error sending feeding schedule notifications: " . $e->getMessage());
            $this->error('Error sending feeding schedule notifications.');
        }
    }
}