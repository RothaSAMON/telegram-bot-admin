<?php

namespace App\Livewire;

use App\Models\TelegramUser;
use App\Models\TelegramMessage;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramChat extends Component
{
    public $selectedUserId = null;
    public $messages = [];
    public $newMessage = '';
    public $user = null;
    
    protected $listeners = [
        'userSelected' => 'loadUser',
        'refreshChat' => '$refresh',
        'echo:new-message,MessageReceived' => 'handleNewMessage',
    ];
    
    public function loadUser($userId)
    {
        $this->selectedUserId = $userId;
        $this->user = TelegramUser::find($userId);
        $this->loadMessages();
        $this->dispatch('chatOpened', userId: $userId);
    }
    
    public function loadMessages()
    {
        if (!$this->selectedUserId) {
            $this->messages = [];
            return;
        }
        
        $this->messages = TelegramMessage::where('telegram_user_id', $this->selectedUserId)
            ->orderBy('created_at', 'asc')
            ->get();
    }
    
    public function sendMessage()
    {
        if (empty($this->newMessage) || !$this->selectedUserId) {
            return;
        }
        
        $user = TelegramUser::find($this->selectedUserId);
        
        if (!$user) {
            session()->flash('error', 'User not found');
            return;
        }
        
        try {
            // Send message via Telegram
            $response = Telegram::sendMessage([
                'chat_id' => $user->telegram_id,
                'text' => $this->newMessage,
            ]);
            
            // Store in database
            TelegramMessage::create([
                'telegram_user_id' => $this->selectedUserId,
                'message_id' => $response->getMessageId(),
                'text' => $this->newMessage,
                'is_from_admin' => true,
                'admin_id' => Auth::id(),
            ]);
            
            // Update last interaction time
            $user->update(['last_interaction_at' => now()]);
            
            $this->newMessage = '';
            $this->loadMessages();
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to send message: ' . $e->getMessage());
        }
    }
    
    public function deleteMessage($messageId)
    {
        $message = TelegramMessage::find($messageId);
        
        if (!$message) {
            session()->flash('error', 'Message not found');
            return;
        }
        
        try {
            // Only try to delete from Telegram if it's a message with a Telegram ID
            if ($message->message_id) {
                Telegram::deleteMessage([
                    'chat_id' => $message->user->telegram_id,
                    'message_id' => $message->message_id,
                ]);
            }
            
            $message->delete();
            $this->loadMessages();
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete message: ' . $e->getMessage());
        }
    }
    
    public function handleNewMessage($event)
    {
        if ($event['telegram_user_id'] == $this->selectedUserId) {
            $this->loadMessages();
        }
    }
    
    public function render()
    {
        return view('livewire.telegram-chat');
    }
}