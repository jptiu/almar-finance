<div x-data="{ open: @entangle('isOpen') }" 
     x-show="open"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 bg-black bg-opacity-50 z-50"
     @click.away="open = false"
>
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-800 dark:text-white rounded-lg w-full max-w-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">New Chat</h3>
                    <button 
                        wire:click="closeModal" 
                        @click="open = false"
                        class="text-gray-400 hover:text-gray-600"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="mb-4">
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="search" 
                        placeholder="Search users..." 
                        class="w-full px-4 py-2 rounded-lg border dark:border-gray-700 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>

                <div class="space-y-2 max-h-[400px] overflow-y-auto">
                    @foreach($users as $user)
                        <div 
                            wire:click="createConversation({{ $user->id }})"
                            wire:loading.attr="disabled"
                            class="flex items-center p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer transition-colors"
                        >
                            <div class="w-10 h-10 rounded-full overflow-hidden mr-3">
                                <img src="{{ $user->avatar_url ?? asset('images/default-avatar.png') }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="font-medium">{{ $user->name }}</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
                            </div>
                        </div>
                    @endforeach

                    @if($users->isEmpty())
                        <div class="text-center py-4 text-gray-500 dark:text-gray-400">
                            No users found
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
