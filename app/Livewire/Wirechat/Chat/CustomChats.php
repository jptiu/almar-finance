<?php

namespace App\Livewire\Wirechat\Chat;

use Livewire\Component;
use Namu\WireChat\Models\Conversation;
use Namu\WireChat\Models\Participant;
use App\Models\User;

class CustomChats extends Component
{
    public $conversations = [];
    public $currentConversation = null;

    protected $listeners = [
        'conversationCreated' => 'loadConversations',
        'conversationSelected' => 'handleConversationSelected'
    ];

    public function mount()
    {
        $this->loadConversations();
    }

    public function loadConversations()
    {
        $this->conversations = Participant::where('participantable_type', User::class)
            ->where('participantable_id', auth()->id())
            ->with(['conversation', 'conversation.participants'])
            ->latest('conversation_read_at')
            ->get()
            ->map(function ($participant) {
                return $participant->conversation;
            });

        // Reset current conversation if it's no longer in the list
        if ($this->currentConversation && !$this->conversations->contains($this->currentConversation->id)) {
            $this->currentConversation = null;
        }
    }

    public function render()
    {
        return view('livewire.wirechat.chat.custom-chats');
    }

    public function startNewChat()
    {
        $this->dispatch('openNewChatModal');
    }

    public function selectConversation($conversationId)
    {
        $conversation = $this->conversations->firstWhere('id', $conversationId);
        if ($conversation) {
            $this->currentConversation = $conversation;
            $this->dispatch('conversationSelected', $conversationId);
        }
    }

    public function handleConversationSelected($conversationId)
    {
        // Only update if the conversation actually changed
        if ($this->currentConversation && $this->currentConversation->id == $conversationId) {
            return;
        }

        $conversation = $this->conversations->firstWhere('id', $conversationId);
        if ($conversation) {
            $this->currentConversation = $conversation;
        }
    }

    public function updatedConversations()
    {
        // Reset current conversation if it's no longer in the list
        if ($this->currentConversation && !$this->conversations->contains($this->currentConversation->id)) {
            $this->currentConversation = null;
        }
    }
}
