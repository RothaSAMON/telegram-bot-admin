<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Models\TelegramUser;
use App\Models\TelegramMessage;

class PollTelegramMessages extends Command
{
    protected $signature = 'telegram:poll-messages';
    protected $description = 'Poll for new Telegram messages';

    public function handle()
    {
        $this->info('Starting to poll for new messages...');

        while (true) {
            try {
                $updates = Telegram::getUpdates();
                
                foreach ($updates as $update) {
                    if (isset($update['message'])) {
                        $message = $update['message'];
                        $from = $message['from'];
                        $text = $message['text'] ?? '';

                        // Skip commands except /start
                        if (str_starts_with($text, '/') && $text !== '/start') {
                            continue;
                        }

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

                        TelegramMessage::updateOrCreate(
                            [
                                'telegram_user_id' => $user->id,
                                'message_id' => $message['message_id']
                            ],
                            [
                                'text' => $text,
                                'is_from_admin' => false,
                            ]
                        );

                        $this->info("New message processed from user: {$user->full_name}");
                    }
                }

                // Clear updates to avoid processing the same messages again
                if (!empty($updates)) {
                    $lastUpdateId = end($updates)['update_id'];
                    Telegram::getUpdates(['offset' => $lastUpdateId + 1]);
                }

                sleep(2); // Poll every 2 seconds
            } catch (\Exception $e) {
                $this->error("Error: " . $e->getMessage());
                sleep(5); // Wait longer if there's an error
            }
        }
    }
}