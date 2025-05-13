<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function chatList()
    {
        $userId = Auth::id();
        
        // Get all user IDs involved in conversations with the current user
        $userIds = ChatMessage::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->pluck('sender_id', 'receiver_id')
            ->unique()
            ->toArray();

        // Flatten the array and remove duplicates
        $userIds = array_unique(array_merge(array_keys($userIds), array_values($userIds)));

        // Exclude the current user
        $userIds = array_filter($userIds, function($id) use ($userId) {
            return $id != $userId;
        });

        // Fetch user details and last message
        $users = User::whereIn('id', $userIds)
            ->get(['id', 'name']); // Only select id and name

        $users = $users->map(function ($user) use ($userId) {
            $lastMessage = ChatMessage::where(function ($query) use ($user, $userId) {
                $query->where('sender_id', $user->id)
                      ->where('receiver_id', $userId);
            })->orWhere(function ($query) use ($user, $userId) {
                $query->where('sender_id', $userId)
                      ->where('receiver_id', $user->id);
            })->orderBy('created_at', 'desc')
              ->first();

            $user->last_message = $lastMessage ? $lastMessage->message : null;
            $user->last_message_time = $lastMessage ? $lastMessage->created_at : null;

            return $user;
        });

        return Inertia::render('ChatList', [
            'users' => $users,
        ]);
    }

    public function index($userId)
{
    $user = auth()->user();
    $messages = ChatMessage::where(function ($query) use ($user, $userId) {
        $query->where('sender_id', $user->id)
              ->where('receiver_id', $userId);
    })->orWhere(function ($query) use ($user, $userId) {
        $query->where('sender_id', $userId)
              ->where('receiver_id', $user->id);
    })->orderBy('created_at', 'asc')->get();

    $sender = User::find($userId);

    return Inertia::render('Chat', [
        'messages' => $messages,
        'userId' => $userId,
        'senderName' => $sender->name,
    ]);
}
public function store(Request $request)
{
    $request->validate([
        'receiver_id' => 'required|integer|exists:users,id',
        'message' => 'required|string',
    ]);

    $message = ChatMessage::create([
        'sender_id' => $request->user()->id,
        'receiver_id' => $request->receiver_id,
        'message' => $request->message,
    ]);

    broadcast(new NewMessage($message))->toOthers();

    return response()->json($message, 201);
}

    public function getMessages($userId)
    {
        $user = auth()->user();
        $messages = ChatMessage::where(function ($query) use ($user, $userId) {
            $query->where('sender_id', $user->id)
                  ->where('receiver_id', $userId);
        })->orWhere(function ($query) use ($user, $userId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', $user->id);
        })->orderBy('created_at', 'asc')->get();

        return response()->json($messages);
    }
}