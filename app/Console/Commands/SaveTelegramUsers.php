<?php

namespace App\Console\Commands;

use App\Models\TelegramUser;
use Illuminate\Console\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

class SaveTelegramUsers extends Command
{
    protected $signature = 'telegram:save-users';
    protected $description = 'Save users who have interacted with the bot';

    public function handle()
    {
        $this->info('Fetching updates from Telegram...');
        
        try {
            $updates = Telegram::getUpdates();
            $count = 0;

            foreach ($updates as $update) {
                if (isset($update['message']['from'])) {
                    $from = $update['message']['from'];
                    
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
                    
                    $count++;
                    $this->info("Saved user: {$user->first_name} (ID: {$user->telegram_id})");
                }
            }

            $this->info("Completed! Processed {$count} users.");
            
        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
        }
    }
}