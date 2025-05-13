<?php

namespace App\Notifications;

use App\Models\ChatMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\WebPushMessage;
use Illuminate\Notifications\Notification;

class NewMessageNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $message;

    public function __construct(ChatMessage $message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['webpush'];
    }

    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title('New Message Received')
            ->body($this->message->message)
            ->action('View Message', 'view_message')
            ->data([
                'message_id' => $this->message->id,
                'url' => 'https://pigconnect.shop/chat/' . $this->message->sender_id
            ]);
    }
}