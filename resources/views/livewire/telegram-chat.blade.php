<div class="bg-white shadow rounded-lg overflow-hidden h-full flex flex-col">
    @if($selectedUserId)
        <div class="p-4 border-b bg-gray-50 flex justify-between items-center">
            <div>
                <h3 class="font-medium">{{ $user->full_name ?: 'Unknown' }}</h3>
                <p class="text-sm text-gray-500">
                    @if($user->username)
                        @ {{ $user->username }}
                    @else
                        ID: {{ $user->telegram_id }}
                    @endif
                </p>
            </div>
            <div class="text-sm text-gray-500">
                Last active: {{ $user->last_interaction_at->diffForHumans() }}
            </div>
        </div>
        
        <div class="flex-1 overflow-y-auto p-4 space-y-4" style="max-height: 500px">
            @forelse($messages as $message)
                <div 
                    wire:key="message-{{ $message->id }}"
                    class="flex {{ $message->is_from_admin ? 'justify-end' : 'justify-start' }}"
                >
                    <div 
                        class="max-w-[70%] p-3 rounded-lg {{ $message->is_from_admin ? 'bg-blue-500 text-white' : 'bg-gray-100' }}"
                    >
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-xs {{ $message->is_from_admin ? 'text-blue-100' : 'text-gray-500' }}">
                                {{ $message->created_at->format('M d, H:i') }}
                            </span>
                            @if($message->is_from_admin)
                                <button 
                                    wire:click="deleteMessage({{ $message->id }})"
                                    class="text-xs text-blue-100 hover:text-white"
                                >
                                    Delete
                                </button>
                            @endif
                        </div>
                        <p class="break-words">{{ $message->text }}</p>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-500 py-8">
                    No messages yet. Start the conversation!
                </div>
            @endforelse
        </div>
        
        <div class="p-4 border-t">
            @if(session('error'))
                <div class="bg-red-100 text-red-700 p-2 rounded mb-2">
                    {{ session('error') }}
                </div>
            @endif
            
            <form wire:submit="sendMessage" class="flex">
                <input
                    wire:model="newMessage"
                    type="text"
                    placeholder="Type your message..."
                    class="flex-1 px-3 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                <button
                    type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-r-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    Send
                </button>
            </form>
        </div>
    @else
        <div class="flex-1 flex items-center justify-center text-gray-500">
            Select a user to start chatting
        </div>
    @endif
</div>