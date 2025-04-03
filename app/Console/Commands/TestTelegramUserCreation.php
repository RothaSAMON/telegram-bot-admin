<?php

namespace App\Console\Commands;

use App\Models\TelegramUser;
use Illuminate\Console\Command;

class TestTelegramUserCreation extends Command
{
    protected $signature = 'telegram:test-user';
    protected $description = 'Test creating a Telegram user in the database';

    public function handle()
    {
        $user = TelegramUser::updateOrCreate(
            ['telegram_id' => '123456789'],
            [
                'first_name' => 'Test',
                'last_name' => 'User',
                'username' => 'testuser',
                'is_bot' => false,
                'language_code' => 'en',
                'last_interaction_at' => now(),
            ]
        );

        $this->info('Test user created with ID: ' . $user->id);
    }
}