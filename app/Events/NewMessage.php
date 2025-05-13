<?php

namespace App\Events;

use App\Models\FeedingSchedule;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FeedingScheduleReminder implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $feedingSchedule;

    public function __construct(FeedingSchedule $feedingSchedule)
    {
        $this->feedingSchedule = $feedingSchedule;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('feeding-schedule.' . $this->feedingSchedule->user_id);
    }
}