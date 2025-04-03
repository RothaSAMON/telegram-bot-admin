<?php

namespace App\Http\Controllers;

use App\Models\TelegramUser;
use App\Models\TelegramMessage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $update = Telegram::commandsHandler(true);
        
        // Process message updates only
        if ($update && isset($update['message'])) {
            $message = $update['message'];
            $from = $message['from'];
            $text = $message['text'] ?? '';
            
            // Skip processing if this is a command
            if (str_starts_with($text, '/') && $text !== '/start') {
                return response()->json(['status' => 'ok']);
            }
            
            // Find or create the user
            $user = TelegramUser::updateOrCreate(
                ['telegram_id' => $from['id']],
                [
                    'first_name' => $from['first_name'] ?? null,
                    'last_name' => $from['last_name'] ?? null,
                    'username' => $from['username'] ?? null,
                    'is_bot' => $from['is_bot'] ?? false,
                    'language_code' => $from['language_code'] ?? null,
                    'last_interaction_at' => now(),
                ]
            );
            
            // Store the message
            TelegramMessage::create([
                'telegram_user_id' => $user->id,
                'message_id' => $message['message_id'],
                'text' => $text,
                'is_from_admin' => false,
            ]);
        }
        
        return response()->json(['status' => 'ok']);
    }
    
    public function setWebhook()
    {
        $response = Telegram::setWebhook(['url' => url('/api/telegram/webhook')]);
        return response()->json(['success' => $response]);
    }
    
    public function getWebhookInfo()
    {
        $response = Telegram::getWebhookInfo();
        return response()->json($response);
    }
}