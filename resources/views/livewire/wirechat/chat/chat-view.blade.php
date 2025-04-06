<div class="flex flex-col h-full bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
    <!-- Messages List -->
    <div class="flex-1 overflow-y-auto p-4 relative" x-data="{
        scrollY: 0,
        scrollContainer: null,
        inputContainer: null,
        scrollToLatest() {
            const container = this.scrollContainer;
            const lastMessage = container.querySelector('.message:last-child');
            if (lastMessage) {
                lastMessage.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        },
        scrollToTop() {
            this.scrollContainer.scrollTo({ top: 0, behavior: 'smooth' });
        },
        focusInput() {
            this.inputContainer.querySelector('input').focus();
        },
        init() {
            this.scrollContainer = this.$el;
            this.inputContainer = this.$refs.inputContainer;
        }
    }"
    x-on:scroll="scrollY = window.scrollY"
    x-on:scrolltolatestmessage.window="scrollToLatest()"
    x-on:load.window="scrollToLatest()"
    x-on:conversationselected.window="scrollToLatest()"
    x-on:messagesent.window="scrollToLatest()"
    x-on:load="scrollToLatest()"
    x-on:conversationselected.window="focusInput()"
    x-on:messagesent.window="focusInput()"
    >
        @if($conversation)
            @if($messages->isEmpty())
                <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-300 dark:text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                    </svg>
                    <p class="mt-2">No messages yet</p>
                </div>
            @else
                @foreach($messages as $message)
                    @php
                        $isOwnMessage = $message->sendable_id == auth()->id();
                        $messageClass = $isOwnMessage ? 'flex justify-end' : 'flex justify-start';
                        $bubbleClass = $isOwnMessage ? 'bg-blue-500 text-white' : 'bg-gray-100 dark:bg-gray-700';
                        $avatarClass = !$isOwnMessage ? 'bg-gray-200 dark:bg-gray-600' : 'hidden';
                        $avatarTextClass = !$isOwnMessage ? 'text-gray-800 dark:text-gray-200' : 'hidden';
                    @endphp
                    
                    <div class="mb-2 {{ $messageClass }} message">
                        <div class="max-w-[80%]">
                            @if(!$isOwnMessage && $message->sendable)
                                <div class="flex-shrink-0 mr-2">
                                    <div class="w-10 h-10 rounded-full {{ $avatarClass }} flex items-center justify-center">
                                        <span class="text-sm font-medium {{ $avatarTextClass }}">{{ $message->sendable->name[0] ?? 'U' }}</span>
                                    </div>
                                </div>
                            @endif
                            <div class="flex flex-col">
                                <div class="flex-1">
                                    <div class="rounded-lg p-3 shadow-sm {{ $bubbleClass }}">
                                        <p class="text-sm break-words">{{ $message->body }}</p>
                                        <p class="text-xs {{ $isOwnMessage ? 'text-gray-200' : 'text-gray-500' }} dark:text-gray-400 mt-1">
                                            {{ $message->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Back to top button -->
                <button 
                    x-show="scrollY > 200"
                    x-on:click="scrollToTop()"
                    class="fixed bottom-4 right-4 bg-blue-500 text-white rounded-full p-2 shadow-lg hover:bg-blue-600 transition-colors opacity-0 transform -translate-y-20 transition-all duration-300 scroll-to-top"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            @endif
        @else
            <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-300 dark:text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                </svg>
                <p class="mt-2">Select a conversation to start chatting</p>
            </div>
        @endif
    </div>

    <!-- Message Input -->
    <div class="border-t bg-white dark:bg-gray-800 pb-4" x-ref="inputContainer">
        @if($conversation)
            <div class="flex items-center gap-2 p-3">
                <!-- Emoji Button -->
                <button 
                    class="p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                    title="Add emoji"
                >
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </button>

                <!-- File Upload -->
                <label 
                    for="file-upload"
                    class="p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors cursor-pointer"
                    title="Upload file"
                >
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                </label>
                <input 
                    id="file-upload"
                    type="file"
                    class="hidden"
                    wire:model="file"
                >

                <!-- Message Input -->
                <input 
                    wire:model="message"
                    wire:keydown.enter="sendMessage"
                    placeholder="Type a message..."
                    class="flex-1 min-h-[40px] px-4 py-2 rounded-lg border dark:border-gray-700 dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200"
                    @keydown="if (event.key === 'Enter' && !event.shiftKey) {
                        event.preventDefault();
                        @this.sendMessage();
                    }"
                    x-ref="messageInput"
                    x-on:load="$refs.messageInput.focus()"
                    x-on:conversationselected.window="$refs.messageInput.focus()"
                >

                <!-- Send Button -->
                <button 
                    wire:click="sendMessage"
                    wire:loading.attr="disabled"
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    <svg wire:loading wire:target="sendMessage" class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    <span wire:loading.remove wire:target="sendMessage">Send</span>
                </button>
            </div>
        @endif
    </div>
</div>
