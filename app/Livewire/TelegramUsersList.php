<?php

namespace App\Livewire;

use App\Models\TelegramUser;
use Livewire\Component;
use Livewire\WithPagination;

class TelegramUsersList extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedUserId = null;

    protected $queryString = ['search'];

    protected $listeners = [
        'refreshUsersList' => '$refresh',
        'chatOpened' => 'markUserMessagesAsRead'
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function selectUser($userId)
    {
        $this->selectedUserId = $userId;
        $this->dispatch('userSelected', userId: $userId);
        $this->dispatch('chatOpened', userId: $userId);
    }

    public function markUserMessagesAsRead($userId)
    {
        $user = TelegramUser::find($userId);
        if ($user) {
            $user->messages()->where('is_read', false)->where('is_from_admin', false)->update(['is_read' => true]);
        }
    }

    public function getUnreadMessagesCount($userId)
    {
        return TelegramUser::find($userId)->messages()->where('is_read', false)->where('is_from_admin', false)->count();
    }

    public function render()
    {
        $users = TelegramUser::where(function ($query) {
            $query->where('first_name', 'like', '%' . $this->search . '%')
                ->orWhere('last_name', 'like', '%' . $this->search . '%')
                ->orWhere('username', 'like', '%' . $this->search . '%');
        })
        ->orderBy('last_interaction_at', 'desc')
        ->paginate(10);

        return view('livewire.telegram-users-list', [
            'users' => $users
        ]);
    }
}