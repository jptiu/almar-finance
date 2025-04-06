<?php

namespace App\Livewire\Wirechat\Chat;

use Livewire\Component;
use Namu\WireChat\Models\Conversation;

class ConversationItem extends Component
{
    public $conversation;
    public $currentConversation;

    public function mount($conversation, $currentConversation)
    {
        $this->conversation = $conversation;
        $this->currentConversation = $currentConversation;
    }

    public function selectConversation()
    {
        $this->dispatch('conversationSelected', $this->conversation->id);
    }

    public function render()
    {
        return view('livewire.wirechat.chat.conversation-item');
    }
}
