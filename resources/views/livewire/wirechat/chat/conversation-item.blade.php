<div 
    wire:click="selectConversation"
    class="flex items-center p-4 border-b hover:bg-gray-50 cursor-pointer {{ $currentConversation && $currentConversation->id == $conversation->id ? 'bg-blue-50 dark:bg-blue-900' : '' }}"
>
    <div class="flex-1">
        <div class="flex items-center">
            <div class="flex-1">
                <h3 class="font-medium text-gray-900">
                    {{ $conversation->participants->firstWhere('participantable_id', '!=', auth()->id())->participantable->name }}
                </h3>
                <p class="text-sm text-gray-500">
                    @if($conversation->messages->isEmpty())
                        No messages yet
                    @else
                        {{ $conversation->messages->last()->body }}
                    @endif
                </p>
            </div>
            <div class="ml-4 text-sm text-gray-500">
                @if($conversation->messages->isEmpty())
                    Never
                @else
                    {{ $conversation->messages->last()->created_at->diffForHumans() }}
                @endif
            </div>
        </div>
    </div>
</div>
