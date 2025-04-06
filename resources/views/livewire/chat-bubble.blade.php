<div class="chat-bubble-wrapper">
    <div class="chat-bubble">
        <!-- Chat Toggle Button -->
        <button 
            wire:click="toggleChat" 
            class="relative bg-blue-600 hover:bg-blue-700 text-white rounded-full p-3 shadow-lg transition-all duration-200"
        >
            @if($unreadCount > 0)
                <div class="notification-dot"></div>
            @endif
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
            </svg>
        </button>

        <!-- Chat Window -->
        @if($isOpen)
            <div 
                class="fixed bottom-20 right-4 w-[40rem] h-[32rem] bg-white dark:bg-gray-800 rounded-lg shadow-xl overflow-hidden"
            >
                <!-- Chat Header -->
                <div class="bg-blue-600 text-white p-4 flex justify-between items-center">
                    <h3 class="font-semibold">Messages</h3>
                    <button 
                        wire:click="toggleChat"
                        class="text-white hover:text-gray-200 transition-colors"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <!-- Chat Content -->
                <div class="h-full overflow-hidden flex">
                    <!-- Conversations List -->
                    <div class="w-[16rem] border-r border-gray-200 dark:border-gray-700">
                        <div class="flex flex-col h-full">
                            <!-- New Chat Button -->
                            {{-- <div class="flex items-center justify-between p-4 border-b">
                                <span class="text-sm text-gray-500">Recent chats</span>
                                <button 
                                    wire:click="startNewChat"
                                    class="text-sm text-blue-600 hover:text-blue-700"
                                >
                                    New chat
                                </button>
                            </div> --}}

                            <!-- Chats List -->
                            <div class="flex-1 overflow-y-auto">
                                <livewire:wirechat.chat.custom-chats />
                            </div>
                        </div>
                    </div>

                    <!-- Messages and Input -->
                    <div class="flex-1 flex flex-col pb-6">
                        <div class="flex-1 overflow-y-auto">
                            <livewire:wirechat.chat.view />
                        </div>
                        <div class="border-t p-4 bg-gray-50 dark:bg-gray-700 overflow-y-auto">
                            <livewire:wirechat.chat.chat-view />
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- New Chat Modal -->
    <livewire:wirechat.chat.new-chat-modal />
</div>
