<div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="p-4 border-b">
        <input
            wire:model.live.debounce.300ms="search"
            type="text"
            placeholder="Search users..."
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
    </div>
    
    <div class="divide-y divide-gray-200 max-h-[600px] overflow-y-auto">
        @forelse($users as $user)
            <div 
                wire:key="user-{{ $user->id }}"
                wire:click="selectUser({{ $user->id }})"
                class="p-4 hover:bg-gray-50 cursor-pointer flex items-center {{ $selectedUserId == $user->id ? 'bg-blue-50' : '' }}"
            >
                <div class="flex-1">
                    <h3 class="font-medium">{{ $user->full_name ?: 'Unknown' }}</h3>
                    <p class="text-sm text-gray-500">
                        @if($user->username)
                            @ {{ $user->username }}
                        @else
                            ID: {{ $user->telegram_id }}
                        @endif
                    </p>
                    <p class="text-xs text-gray-400">
                        Last active: {{ $user->last_interaction_at->diffForHumans() }}
                    </p>
                </div>
                
                @php
                    $unreadCount = $this->getUnreadMessagesCount($user->id);
                @endphp
                
                @if($unreadCount > 0)
                    <div class="bg-red-500 text-white rounded-full h-6 w-6 flex items-center justify-center text-xs">
                        {{ $unreadCount }}
                    </div>
                @endif
            </div>
        @empty
            <div class="p-4 text-center text-gray-500">
                No users found.
            </div>
        @endforelse
    </div>
    
    <div class="p-2 border-t">
        {{ $users->links() }}
    </div>
</div>