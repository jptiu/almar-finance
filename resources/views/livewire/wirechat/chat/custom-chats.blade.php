<div>
    <!-- New Chat Button -->
    <div class="flex items-center justify-between p-4 border-b">
        <span class="text-sm text-gray-500">Recent chats</span>
        <button 
            wire:click="startNewChat"
            class="text-sm text-blue-600 hover:text-blue-700"
        >
            New chat
        </button>
    </div>

    <!-- Chats List -->
    <div class="flex-1 overflow-y-auto">
        @foreach($conversations as $conversation)
            <livewire:wirechat.chat.conversation-item 
                :conversation="$conversation" 
                :current-conversation="$currentConversation" 
                :key="'conversation-item-' . $conversation->id"
            />
        @endforeach

        @if($conversations->isEmpty())
            <div class="text-center py-4 text-gray-500 dark:text-gray-400">
                No conversations yet
            </div>
        @endif
    </div>
</div>
