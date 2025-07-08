<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MessageNotificationController extends Controller
{
    public function getNotifications()
    {
        $user = Auth::user();
        
        // Debug log
        Log::info('Fetching notifications for user: ' . $user->id);
        
        // Get unread messages from the last 24 hours
        $notifications = ChatMessage::where('receiver_id', $user->id)
            ->where('read', false)
            ->where('created_at', '>=', now()->subDay())
            ->with('sender')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Debug log
        Log::info('Found notifications: ' . $notifications->count());
        
        $formattedNotifications = $notifications->map(function ($message) {
            $sender = User::find($message->sender_id);
            return [
                'id' => $message->id,
                'sender' => $sender ? $sender->name : 'Unknown',
                'sender_id' => $message->sender_id,
                'message' => $message->message,
                'time' => $message->created_at->diffForHumans(),
                'read' => $message->read ?? false,
            ];
        });

        $unreadCount = ChatMessage::where('receiver_id', $user->id)
            ->where('read', false)
            ->count();

        // Debug log
        Log::info('Unread count: ' . $unreadCount);

        return response()->json([
            'notifications' => $formattedNotifications,
            'unread_count' => $unreadCount,
        ]);
    }

    public function markAsRead($messageId)
    {
        $message = ChatMessage::where('receiver_id', Auth::id())
            ->where('id', $messageId)
            ->first();

        if ($message) {
            $message->update(['read' => true]);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
} 